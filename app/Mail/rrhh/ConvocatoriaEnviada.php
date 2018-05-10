<?php

namespace App\Mail\rrhh;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConvocatoriaEnviada extends Mailable
{
    use Queueable, SerializesModels;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('avca2018@gmail.com', 'AVCA')
            ->subject('CONVOCATORIA PARA ENTREVISTA PRELIMINAR (AVCA)')
            ->view('rrhh.emails.convocatoria_preliminar')
            ->with([
                'nombre' => $this->data['nombre'],
                'lugar' => $this->data['lugar'],
                'fecha' => $this->data['fecha'],
                'hora' => $this->data['hora'],
                'recaudos' => $this->data['recaudos']
            ]);
    }
}
