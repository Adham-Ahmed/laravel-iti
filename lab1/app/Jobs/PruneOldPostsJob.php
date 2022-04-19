<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    // protected $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->post = $post;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Post::create(
        //     [
        //         'title' =>'proneJobWorking!',
        //         'description' =>'proneJobWorking!',
        //         'user_id' =>5
        //     ] 
        //  );

        Post::where('created_at', '<=', Carbon::now()->subYears(2)->toDateTimeString())->delete();
    }
}
