<?php

namespace App\Jobs;

use App\Mail\ProductAddedMail;
use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendProductAddedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->product->isActive()) {

            $subscribers = Subscriber::all(['email'])->toArray();

            Mail::to($subscribers[0])
                ->bcc(array_slice($subscribers, 1))
                ->send(new ProductAddedMail($this->product));
        }

    }
}
