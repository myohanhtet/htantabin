<?php


namespace App\Traits;


use App\Classes\MmTcpdf;
use App\Models\LuckyDraw;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

trait PrintPdf
{
    public function printPdf($id,$model = null)
    {

        $pdf = new MmTcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Myo Han Htet');
        $pdf->SetTitle('လက်ခံဖြတ်ပိုင်း');
        $pdf->SetSubject('စာရေးတံမဲနှင့်ပဋ္ဌာန်းအလှူတော် လက်ခံဖြတ်ပိုင်း');
        $pdf->SetKeywords('Yangon, Monastery, Htantabin Monastery');

        // remove default header/footer
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $fontName = \TCPDF_FONTS::addTTFfont('fonts/Zawgyi-One.ttf', 'TrueTypeUnicode','', 96);
        $pdf->SetFont($fontName, '', 11, '', false);


        if (\request()->route()->getName() == "lucky.show" || \request()->route()->getName() == 'lucky.update' || \request()->route()->getName() == 'lucky.store'){
            $luckydraw = LuckyDraw::find($id);


            // Create QR code
            $writer = new PngWriter();

// Create QR code
            $qrCode = QrCode::create('Data')
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize(300)
                ->setMargin(10)
                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));

// Create generic logo
            $logo = Logo::create(asset('images/logo.png'))
                ->setResizeToWidth(50);

// Create generic label
            $label = Label::create('Label')
                ->setTextColor(new Color(255, 0, 0));

            $result = $writer->write($qrCode, $logo, $label);
            $data = $result->getDataUri();
            $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
            $view = view('pdf.luckydraw',['luckydraw' => $luckydraw,'data' =>$data ]);
            $fileLocation = public_path('invoices/lucky_draw/');
            $fileName = $id.'_'.date('Y_m_i_s').'.pdf';
        } elseif (\request()->route()->getName() == "lucky.search") {
            $pdf->SetMargins(30, 0, 10, true);
            $luckys = LuckyDraw::where('lucky_no',$id)
                ->where('times',setting('times'))->get();
            $view = view('pdf.luckylist',['luckys'=>$luckys,'lucky_number' => $id]);
            $fileLocation = public_path('invoices/lucky_list/');
            $fileName = $id.'_'.date('Y_m_i_s').'.pdf';
        } elseif (\request()->route()->getName() == "pathans.show" || \request()->route()->getName() == 'pathans.update' || \request()->route()->getName() == 'pathans.store'){

            $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
            $view = view('pdf.pathan',['pathan' => $model,'params'=>$params]);
            $fileLocation = public_path('invoices/pathans/');
            $fileName = $id.'_'.date('Y_m_i_s').'.pdf';
        }

        $html = $view->render();
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $pdf->Output($fileLocation . $fileName ,'F');

        return $fileName;
    }
}
