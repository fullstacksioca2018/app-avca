<?php

namespace App\Mail\online;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompraBoleto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('avca2018@gmail.com', 'AVCA')
            ->subject('COMPRA DE BOLETO ONLINE')
            ->view('online.emails.comprar_boleto')
            ->with([
                
            ]);        
    }
}
