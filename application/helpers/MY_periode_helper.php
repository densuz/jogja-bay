<?php
function dateDifference($date_1=null , $date_2=null , $differenceFormat = '%a' )
{
    date_default_timezone_set('Asia/Jakarta');
    //////////////////////////////////////////////////////////////////////
    //PARA: Date Should In YYYY-MM-DD Format
    //RESULT FORMAT:
    // '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'        =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
    // '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
    // '%m Month %d Day'                                            =>  3 Month 14 Day
    // '%d Day %h Hours'                                            =>  14 Day 11 Hours
    // '%d Day'                                                        =>  14 Days
    // '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
    // '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
    // '%h Hours                                                    =>  11 Hours
    // '%a Days                                                        =>  468 Days
    //////////////////////////////////////////////////////////////////////

    $months= [
        'January'   => '01',
        'February'  => '02',
        'March'     => '03',
        'April'     => '04',
        'May'       => '05',
        'June'      => '06',
        'July'      => '07',
        'August'    => '08',
        'September' => '09',
        'October'   => '10',
        'November'  => '11',
        'December'  => '12',
    ];
    /*$date_1 or $date_2 format = January 2019 */
    $date1_explode= explode(' ', $date_1);
    $date2_explode= explode(' ', $date_2);

    /* mod date from January 2019 to 2019-01-01 */
    $date1_mod= "{$date1_explode[1]}-{$months[ $date1_explode[0] ]}-01";
    $date2_mod= "{$date2_explode[1]}-{$months[ $date2_explode[0] ]}-30";

    $datetime1 = date_create($date1_mod);
    $datetime2 = date_create($date2_mod);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    // return [
    //     'datetime1'             => $datetime1,
    //     'datetime2'             => $datetime2,
    //     'interval'              => $interval,
    //     "{$differenceFormat}"   => $interval->format($differenceFormat),
    // ];
    
}
/* echo '<pre>';
print_r(dateDifference('January 2019','January 2019','%m'));
echo '</pre>'; */

function hasil_akhir_mod($start,$end,$differenceFormat='year')
{
    /* $start = $month = strtotime('2009-02-01');
    $end = strtotime('2011-01-01');
    while($month < $end)
    {
        echo date('F Y', $month), PHP_EOL;
        $month = strtotime("+1 month", $month);
    } */

    $start = $month = strtotime($start);
    $end = strtotime("+1 {$differenceFormat}", strtotime($end) );

    $data=[];
    while($month < $end)
    {
        switch ( $differenceFormat ) {
            case 'year':
                $data[]= (object) [
                    'tahun_penilaian'=> date('Y', $month),
                ];
                $month = strtotime("+1 year", $month);
                break;

            case 'month':
                $data[]= (object) [
                    'tanggal'=> date('Y-m-d H:i:s', $month),
                    'tahun_penilaian'=> date('Y', $month),
                    'bulan_penilaian'=> date('F', $month),
                    'id_bulan'=> date('n', $month),
                ];
                $month = strtotime("+1 month", $month);
                break;

            
            default:
                # code...
                break;
        }
        
    }
        
    return $data;
}

// echo '<pre>';
// print_r(hasil_akhir_mod('January 2019','January 2019','month'));
// echo '</pre>';