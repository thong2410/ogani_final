<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;


class shoppingmail extends Mailable
{
    use Queueable, SerializesModels;
public $Order;
public $OrderDetail
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $Order $OrderDetail)
    {
        $this->Odder=$Order;
        $this->OrderDetail=$OrderDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.shoppingmail');
    }
}
