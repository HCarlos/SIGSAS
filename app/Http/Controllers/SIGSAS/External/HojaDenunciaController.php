<?php

namespace App\Http\Controllers\SIGSAS\External;

use App\Classes\Denuncia\DenunciaTCPDF;
use App\Http\Controllers\Controller;
use App\Models\SIGSAS\Denuncias\Denuncia;
//use const App\Http\Controllers\External\Denuncia\NOMBRE_EMPRESA;
//use const App\Http\Controllers\External\Denuncia\PDF_IMAGE_SCALE_RATIO;

//use Carbon\Carbon;

define('NOMBRE_EMPRESA',config('atemun.nombre_empresa',''));

class HojaDenunciaController extends Controller
{

    public function imprimirDenuncia($UUID=""){

        $den = Denuncia::all()->where('uuid',$UUID)->first();

        $alto   = 6;

        $pdf = new DenunciaTCPDF('','mm',array(215.9, 139.7), true, 'UTF-8', false);
        $pdf->FOLIO = $den->folio_dac;
        $pdf->folio = $den->id;
        $pdf->timex = $den->fecha_ingreso_solicitud;

        $pdf->Init();
        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setX(5);
        $pdf->Ln(40);
        $pdf->SetLeftMargin(50);
        $pdf->SetRightMargin(40);
        $pdf->setFormDefaultProp([279,140]);
        $pdf->SetFont(FONT_AEALARABIYA,'B',11);
        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $roles = $den->ciudadano->RoleNameStrArray;
        $username = $den->ciudadano->username;
        $html = ATEMUN['style']['denuncia'];
        $html .= "<p>Estimado <bAzul>C. {$den->ciudadano->FullName}</bAzul> (<bChocolate>{$den->ciudadano->id}</bChocolate>, <bOrange>$username</bOrange>), su petición ha sido recibida y se iniciará el trámite pertinente. <br><br>";
        $html .= "El <b>". NOMBRE_EMPRESA . "</b> agradece su colaboración y le garantiza confidencialidad y una pronta respuesta.  <br><br>";
        $html .= "Fue atendido por <bVerde>C. {$den->creadopor->FullName}</bVerde>. <br>";
        $html .= "</p>";
        $html .= "<span></span>";
        $html .= "<pCentrado>";
        $html .= env('INFO_TWO'). "<br>";
        $html .= "<span></span>";
        $html .= "<a href='".env('INFO_FOUR')."'>".env('INFO_FOUR'). "</a>";
        $html .= "</pCentrado>";

        $pdf->WriteHTMLCell(195,$alto,10,$pdf->getY(),$html,0,0);

        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $firma = $den->firmas->last();

        if ($firma){

            $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
            $pdf->WriteHTMLCell(200,$alto,5,107, "<p><bSelloBold>CADENA ORIGINAL:</bSelloBold></p>",0,0);
            $pdf->SetFont(FONT_AEALARABIYA,'',6);
            $pdf->WriteHTMLCell(200,$alto,5,110, $firma->cadena_original,0,0);

            $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
            $pdf->WriteHTMLCell(200,$alto,5,117, "<bSelloBold>HASH:</bSelloBold>",0,0);
            $pdf->SetFont(FONT_AEALARABIYA,'',6);
            $pdf->WriteHTMLCell(200,$alto,5,120, $firma->hash,0,0);

            $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
            $pdf->WriteHTMLCell(200,$alto,5,124, "<bSelloBold>SELLO DIGITAL:</bSelloBold>",0,0);
            $pdf->SetFont(FONT_AEALARABIYA,'',6);
            $pdf->WriteHTMLCell(200,$alto,5,127, $firma->sello,0,0);

        } else {

            $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
            $pdf->WriteHTMLCell(200,$alto,5,107, "",0,0);
            $pdf->SetFont(FONT_AEALARABIYA,'',6);
            $pdf->WriteHTMLCell(200,$alto,5,110, "* Escanee la imagen QR para ver el avance en la gestión de su solicitud.",0,0);

        }

        $pdf->Output($pdf->FOLIO . '.pdf');

    }


}
