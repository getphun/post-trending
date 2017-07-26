<?php
/**
 * Post trending counter
 * @package post-trending
 * @version 0.0.1
 * @upgrade true
 */

namespace PostTrending\Controller;
use Post\Model\Post;
use PostTrending\Model\PostTrending as PTrending;

class PostController extends \SiteController
{
    private function calculate($config, $client){
        $view_id    = $this->setting->google_analytics_view;
        $date_start = $config['start'];
        $date_end   = date('Y-m-d');
        $options    = [
            'filters'       => 'ga:pagePath=@/post/read',
            'dimensions'    => 'ga:pagePath',
            'sort'          => '-ga:pageviews',
            'max-results'   => ( $config['items'] + ceil($config['items']/2) )
        ];
        
        $result = $client->data_ga->get('ga:' . $view_id, $date_start, $date_end, 'ga:pageviews', $options);
        if($result->error)
            return $result->error;
        
        $rows = $result->rows;
        if(!count($rows))
            return 'No API result';
        
        $slugs = [];
        
        foreach($rows as $row){
            $slug = str_replace('/post/read/', '', $row[0]);
            $slugs[$slug] = $row[1];
        }
        
        $posts = Post::get(['slug'=>array_keys($slugs), 'status'=>4], true);
        if(!$posts)
            return 'No post found';
        
        $insert = [];
        foreach($posts as $post){
            $insert[] = [
                'post'  => $post->id,
                'views' => $slugs[$post->slug]
            ];
        }
        
        usort($insert, function($a,$b){
            return $b['views'] - $a['views'];
        });
        
        PTrending::truncate();
        PTrending::createMany($insert);
        
        return count($insert) . ' inserted';
    }
    
    public function calculateAction(){
        $config = $this->config->{'post-trending'};
        $ga_client = $this->google->getGAClient();
        
        $config = [
            'start' => date('Y-m-d', strtotime((0 - $config['last_days']).' days')),
            'items' => $config['total_items']
        ];
        
        $result = $this->calculate($config, $ga_client);
        
        $this->ajax(['error'=>false, 'data'=>$result]);
    }
}