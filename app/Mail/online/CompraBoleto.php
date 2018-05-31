<?php

namespace App\Mail\online;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompraBoleto extends Mailable
{
    use Queueable, SerializesModels;
    private $boletos, $usuarios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($boletos, $usuarios, $datos_vuelos, $factura)
    {
        //
        $this->boletos = $boletos;
        $this->datos_vuelos = $datos_vuelos;
        $this->factura = $factura;
        $this->usuarios = $usuarios;
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
            ->with('boletos',$this->boletos)
            ->with('usuarios',$this->usuarios)
            ->with('factura',$this->factura)
            ->with('datos_vuelos',$this->datos_vuelos);        
    }
}
