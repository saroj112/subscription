<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Website;

class Newsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    public $timeout = 7200; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $website = Website::with('users')->find($this->post->website_id);
        $mail['subject'] = 'Newsletter from '.$website->name;

        foreach ($website->users as $user) {
            $mail['email'] = $user->email;
            $mail['name'] = $user->name;
            
            $post = ['title' => $this->post->title, 'description' => $this->post->description,];
            \Mail::send('mails.newsletter', $post, function($message) use($mail){
                $message->to($mail['email'], $mail['name'])
                        ->subject($mail['subject'])
                        ->from('noreply@inisev.com','Newletter Subscription Email');
            });
        }
    }
}
