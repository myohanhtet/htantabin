<?php


namespace App\Classes;


class MmTcpdf extends \TCPDF
{

    public function header()
    {
        $fontName = \TCPDF_FONTS::addTTFfont('fonts/Zawgyi-One.ttf', 'TrueTypeUnicode','', 96);
        $this->SetFont($fontName, '', 12, '', false);
        // QRCODE,L : QR-CODE Low error correction

        $this->SetY(8);
//        $this->writeHtml('<span style="text-align:center;line-height:2;">'.(setting('luckydraw-invoice-title-one') == null ? "Invoice Title One": uni2zg(setting('luckydraw-invoice-title-one')) ).'<br>
//'.(setting('luckydraw-invoice-title-two') == null ? "Invoice Title Two": uni2zg(setting('luckydraw-invoice-title-two'))).'<br>
//'.(setting('luckydraw-invoice-title-three') == null ? "Invoice title Three": uni2zg(setting('luckydraw-invoice-title-three'))).'</span><br>');
    }

}
