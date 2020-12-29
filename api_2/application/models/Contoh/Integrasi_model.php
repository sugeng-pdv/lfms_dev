<?php

class Integrasi_model extends CI_Model {
    private $db1;
    private $db2;
    
    public function __construct()
    {
        $this->load->database();
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function process($id){    
        //check data
        $result = '';
        $this->load->model('nota_all2_model');
        $this->load->model('nota_all_model');
        $this->load->model('invheader_model');
        $this->load->model('invlines_model');
        $exist = $this->invheader_model->get(array('TRX_NUMBER'=>$id));
        if($exist ==''){
            // die('test123');
            // process insert header            
            $data1= $this->nota_all2_model->get(array('NO_NOTA'=>$id));  
            $data = $this->InsertItosTTH2($data1);

            $result = $this->invheader_model->insert($data);
            
            if ($result->status=='success'){
                // process insert detail
                $data2= $this->nota_all_model->get_all(array('KD_PERMINTAAN'=>$id));  
                        
                foreach ($data2 as $key->$value) {                                   
                    if($key=='LINE_NUMBER'){
                        $data2= $this->nota_all_model->get(array('LINE_NUMBER'=>$value));  
                        // $result = $this->invheader_model->insert($data);
                    }
                    // $result = $this->invheader_model->insert($data);  
                    echo($data2);  
                }
            }
        }
        return $result;
    }

    public function processpay($data)
        {     
         // print_r($data);die;
        $result = '';
        $this->load->model('other_model');
        $this->load->model('invlines_model');

            $id_nota = $data['ID_NOTA'];
            $method = $data['RECEIPT_METHOD'];
            $bank = $data['RECEIPT_ACCOUNT'];
            $layanan = $data['LAYANAN'];
            $total = $data['TOTAL'];
            $status = $data['STATUS'];
            $databank = $this->getBankID($bank);
            $bank_account = $databank['BANK_ACCOUNT_NAME'];
            $bank_id       = $databank['BANK_ID'];
            $bank_receiptmethod  = $databank['RECEIPT_METHOD'];
             // print_r($bank_receiptmethod);die;

              // print_r($databank);die;
            $data1 = $this->getNota($layanan, $id_nota);
            //$data1['RECEIPT_METHOD'] = 'JBI BANK';
            $data1['RECEIPT_METHOD'] = $method;
            $data1['RECEIPT_ACCOUNT'] = $bank;
            $data1['LAYANAN'] = $layanan;
            $data1['STATUS'] = 'P';
            $data1['TGL_PAYMENT'] = date("d-M-Y");
            $data1['RECEIPT_ACCOUNT'] = $bank_account;
            $data1['ID_BANK']   = $bank_id;

            // print_r($data);die();
            $data2 = $this->InsertReceipH($data1);
            $this->load->model('receipts_model');
            $result = $this->receipts_model->insert($data2);
             // print_r($data2);die;
            
                if ($result){
                     // print_r($result);die;
                    // process UPDATE source
                    $update = array(
                        'ID_NOTA'=>$id_nota,
                        'LAYANAN'=>$layanan,
                        'STATUS'=>'P',
                        'PAYMENT_VIA'=>$bank,
                    );
                    $result = $this->UpdateNotaSource($update);

                    //insert invoice header
                    
                    $datah = $this->InsertNotaH($data1);
                    // print_r($datah);die;
                    $this->db->insert('XEINVC_AR_INVOICE_HEADER',$datah);
                    $num_inserts = $this->db->affected_rows();
                    
                    // print_r($num_inserts);die;

                    $updateL = array(
                        'ID_NOTA'=>$id_nota,
                        'LAYANAN'=>$layanan,
                        'STATUS'=>'P',
                        'KD_MODUL'=>$data1['KD_MODUL'],
                    );
                                        
                    $idreq = $data1['ID_REQ']; //TGL_SIMPAN
                    $tglsimpan = $data1['TGL_SIMPAN'];

                    $data2 = $this->getNotaD($layanan, $id_nota);
                    //   print_r($data1);die; //SERVICE_TYPE
                    $dataline = array();
                    foreach ($data2 as $key=>$value) {  
                        $dataline[$key] = $value;
                        $dataline[$key]['ID_REQ']= ($idreq);
                        $dataline[$key]['SERVICE_TYPE']= ($layanan);
                        $dataline[$key]['CREATION_DATE']= ($tglsimpan);
                        $dataline[$key]['LAST_UPDATED_DATE']= ($tglsimpan);
                        $dataline[$key] = $this->InsertNotaD($key, $dataline);

                    }
                    // print_r($dataline);die;
                    $this->db->insert_batch('XEINVC_AR_INVOICE_LINES',$dataline);
                    $result = $this->UpdateNotaSource($update);
                    
                }
            // }
        // }
        return $result;
    }

    public function InsertItosTTH2($data){

       $InsertData = array(
            'BILLER_REQUEST_ID' => $data->NO_REQUEST,
            'ORG_ID' => $data->ORG_ID,
            'TRX_NUMBER' => $data->NO_NOTA,
            'TRX_NUMBER_ORIG' => '', 
            'TRX_NUMBER_PREV' => '',
            'TRX_TAX_NUMBER' => $data->NO_FAKTUR_PAJAK,
            'TRX_DATE' => $data->DATE_CREATED,  
            'TRX_CLASS' => '',  
            'TRX_TYPE_ID' => '',  
            'PAYMENT_REFERENCE_NUMBER' => '',  
            'REFERENCE_NUMBER' => '', 
            'CURRENCY_CODE' => $data->SIGN_CURRENCY,
            'CURRENCY_TYPE' => '',  
            'CURRENCY_RATE' => '',  
            'CURRENCY_DATE' => '', 
            'AMOUNT' => $data->TOTAL,
            'CUSTOMER_NUMBER' => $data->CUST_NO,
            'CUSTOMER_CLASS' => '',  
            'BILL_TO_CUSTOMER_ID' => '',  
            'BILL_TO_SITE_USE_ID' => '',  
            'TERM_ID' => '',  
            'STATUS' => '',  
            'HEADER_CONTEXT' => 'PTKM',
            'HEADER_SUB_CONTEXT' => $data->JENIS_MODUL,
            'START_DATE' => '',  
            'END_DATE' => '',  
            'TERMINAL' => '',  
            'VESSEL_NAME' => $data->VESSEL,  
            'BRANCH_CODE' => '',  
            'ERROR_MESSAGE' => '',  
            'API_MESSAGE' => '',  
            'CREATED_BY' => '',  
            'CREATION_DATE' => '',  
            'LAST_UPDATED_BY' => '',  
            'LAST_UPDATE_DATE' => '',  
            'LAST_UPDATE_LOGIN' => '',  
            'CUSTOMER_TRX_ID_OUT' => '',  
            'PROCESS_FLAG' => '',  
            'ATTRIBUTE1' => $data->NO_DO,
            'ATTRIBUTE2' => $data->NOMOR_BL_PEB,
            'ATTRIBUTE3' => $data->BONGKAR_MUAT,
            'ATTRIBUTE4' => $data->VESSEL,
            'ATTRIBUTE5' => $data->VOYAGE_IN.'-'.$data->VOYAGE_OUT,
            'ATTRIBUTE6' => $data->TANGGAL_TIBA,
            'ATTRIBUTE7' => $data->PENUMPUKAN_FROM,
            'ATTRIBUTE8' => $data->PENUMPUKAN_TO,
            'ATTRIBUTE9' => $data->NOTAPREV,
            'ATTRIBUTE10' => '',  
            'ATTRIBUTE11' => '',  
            'ATTRIBUTE12' => '',  
            'ATTRIBUTE13' => '',  
            'ATTRIBUTE14' => '',  
            'ATTRIBUTE15' => '',  
            'INTERFACE_HEADER_ATTRIBUTE1' => '',  
            'INTERFACE_HEADER_ATTRIBUTE2' => '',  
            'INTERFACE_HEADER_ATTRIBUTE3' => '',  
            'INTERFACE_HEADER_ATTRIBUTE4' => '',  
            'INTERFACE_HEADER_ATTRIBUTE5' => '',  
            'INTERFACE_HEADER_ATTRIBUTE6' => '',  
            'INTERFACE_HEADER_ATTRIBUTE7' => '',  
            'INTERFACE_HEADER_ATTRIBUTE8' => '',  
            'INTERFACE_HEADER_ATTRIBUTE9' => '',  
            'INTERFACE_HEADER_ATTRIBUTE10' => '',  
            'INTERFACE_HEADER_ATTRIBUTE11' => '',  
            'INTERFACE_HEADER_ATTRIBUTE12' => '',  
            'INTERFACE_HEADER_ATTRIBUTE13' => '',  
            'INTERFACE_HEADER_ATTRIBUTE14' => '',  
            'INTERFACE_HEADER_ATTRIBUTE15' => '', 
            'CUSTOMER_ADDRESS' => '', 
            'CUSTOMER_NAME' => '',  
            'SOURCE_SYSTEM' => '',  
            'AR_STATUS' => '',
            'CUSTOMER_NPWP' => '',
            'SOURCE_INVOICE' => 'ITOSJBI_NBM',
            'AR_MESSAGE' => ''
        );

        
        return $InsertData;
    }
    
    public function InsertItosTTH($data){
        
               $InsertData = array(
                    'BILLER_REQUEST_ID' => $data->KD_PERMINTAAN,
                    'TRX_NUMBER' => $data->KD_PERMINTAAN,
                    'LINE_ID' => '', 
                    'LINE_NUMBER' => $data->LINE_NUMBER,
                    'DESCRIPTION' => $data->KETERANGAN,
                    'MEMO_LINE_ID' => '',  
                    'GL_REV_ID' => '',  
                    'LINE_CONTEXT' => '',  
                    'TAX_FLAG' => '',  
                    'SERVICE_TYPE' => '', 
                    'EAM_CODE' => '',
                    'LOCATION_TERMINAL' => '',  
                    'AMOUNT' =>  $data->TOTTARIF,
                    'TAX_AMOUNT' => '',
                    'START_DATE' => $data->TOTAL,
                    'END_DATE' => $data->CUST_NO,
                    'CREATED_BY' => '',  
                    'CREATION_DATE' => '',  
                    'LAST_UPDATED_BY' => '',  
                    'LAST_UPDATED_DATE' => '',  
                    'INTERFACE_LINE_ATTRIBUTE1' => '',  
                    'INTERFACE_LINE_ATTRIBUTE2' => $data->EI,
                    'INTERFACE_LINE_ATTRIBUTE3' => $data->OI,
                    'INTERFACE_LINE_ATTRIBUTE4' => $data->CRANE,
                    'INTERFACE_LINE_ATTRIBUTE5' => '',  
                    'INTERFACE_LINE_ATTRIBUTE6' => $data->SIZE_TYPE_STAT_HAZ, 
                    'INTERFACE_LINE_ATTRIBUTE7' => '',  
                    'INTERFACE_LINE_ATTRIBUTE8' => '',  
                    'INTERFACE_LINE_ATTRIBUTE9' => $data->TOTHARI,
                    'INTERFACE_LINE_ATTRIBUTE10' => '',  
                    'INTERFACE_LINE_ATTRIBUTE11' => '',  
                    'INTERFACE_LINE_ATTRIBUTE12' => '',  
                    'INTERFACE_LINE_ATTRIBUTE13' => '',  
                    'INTERFACE_LINE_ATTRIBUTE14' => '',  
                    'INTERFACE_LINE_ATTRIBUTE15' => '',  
                );
                
                //mereplace data
                $service = $this->getServiceType($data->KD_PERMINTAAN);
                foreach($InsertData as $key=>$value){
                    if($key=='SERVICE_TYPE'){
                        $data[$key]=$service;
                    }
                }
                return $InsertData;
            }
    
            
    public function InsertNotaH($data){
        // print_r($data);die;
        $orgid = '0';
        $custid = '';
        $curr = '';
        $orgid = $this->getOrgID();
        $termid = $this->getTerminal();
        if ($data['EMKL']!='')  $custid =  $this->getCustID($data['EMKL']);
        if ($data['VAL']=='') {
            $curr =  'IDR';
        } else {
            $curr =  $data['VAL'];
        }
        if ($custid=='')  $custid =  '123';
        

               $InsertData = array(
                    'BILLER_REQUEST_ID' => $data['ID_REQ'],
                    'ORG_ID' => $orgid, //belum
                    'TRX_NUMBER' => $data['ID_NOTA'],
                    'TRX_NUMBER_ORIG' => '', 
                    'TRX_NUMBER_PREV' => '',
                    'TRX_TAX_NUMBER' => $data['NO_FAKTUR'],
                    'TRX_DATE' => $data['TGL_SIMPAN'],  
                    'TRX_CLASS' => 'INV',  
                    'TRX_TYPE_ID' => '1',  
                    'PAYMENT_REFERENCE_NUMBER' => '',  
                    'REFERENCE_NUMBER' => '', 
                    'CURRENCY_CODE' => $curr,
                    'CURRENCY_TYPE' => '',  
                    'CURRENCY_RATE' => '',  
                    'CURRENCY_DATE' => '', 
                    'AMOUNT' => $data['TOTAL'],
                    'CUSTOMER_NUMBER' => $custid,
                    'CUSTOMER_CLASS' =>'',  
                    'BILL_TO_CUSTOMER_ID' => '',  
                    'BILL_TO_SITE_USE_ID' => '',  
                    'TERM_ID' => '',  
                    'STATUS' =>  $data['STATUS'], 
                    'HEADER_CONTEXT' => 'PTKM',
                    'HEADER_SUB_CONTEXT' => $data['KD_MODUL'],
                    'START_DATE' => '',  
                    'END_DATE' => '',  
                    'TERMINAL' => '',  
                    'VESSEL_NAME' => $data['VESSEL'],  
                    'BRANCH_CODE' => '',  
                    'ERROR_MESSAGE' => '',  
                    'API_MESSAGE' => '',  
                    'CREATED_BY' => '1',  
                    'CREATION_DATE' => $data['TGL_SIMPAN'],  //'',  
                    'LAST_UPDATED_BY' => '123',  
                    'LAST_UPDATE_DATE' => $data['TGL_SIMPAN'],  //'',  
                    'LAST_UPDATE_LOGIN' => '1',  
                    'CUSTOMER_TRX_ID_OUT' => '',  
                    'PROCESS_FLAG' => '',  
                    'ATTRIBUTE1' => '', // $data['NO_DO'],
                    'ATTRIBUTE2' => '', //$data['NOMOR_BL_PEB'],
                    'ATTRIBUTE3' => '', //$data['BONGKAR_MUAT'],
                    'ATTRIBUTE4' => $data['VESSEL'],
                    'ATTRIBUTE5' => $data['VOYAGE_IN'].'-'.$data['VOYAGE_OUT'],
                    'ATTRIBUTE6' => '', //$data['TANGGAL_TIBA'],
                    'ATTRIBUTE7' => '', //$data['PENUMPUKAN_FROM'],
                    'ATTRIBUTE8' => '', //$data['PENUMPUKAN_TO'],
                    'ATTRIBUTE9' => '', //$data['NOTAPREV'],
                    'ATTRIBUTE10' => '',  
                    'ATTRIBUTE11' => '',  
                    'ATTRIBUTE12' => '',  
                    'ATTRIBUTE13' => '',  
                    'ATTRIBUTE14' => '',  
                    'ATTRIBUTE15' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE1' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE2' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE3' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE4' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE5' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE6' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE7' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE8' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE9' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE10' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE11' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE12' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE13' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE14' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE15' => '', 
                    'CUSTOMER_ADDRESS' =>  $data['ALAMAT'], 
                    'CUSTOMER_NAME' =>  $data['EMKL'],  
                    'SOURCE_SYSTEM' => '',  
                    'AR_STATUS' => '',
                    'SOURCE_INVOICE' => 'ITOSJBI_NBM',
                    'AR_MESSAGE' => '',
                    'CUSTOMER_NPWP' => $data['NPWP'],  
                    'PER_KUNJUNGAN_FROM' => '',
                    'PER_KUNJUNGAN_FROM' => '',
                    'JENIS_PERDAGANGAN' => ''
                );
        
        
                return $InsertData;
            
            }
            
    public function InsertNotaD($key,$data){          
        $orgid = $this->getOrgID();
        $keterangan = $data[$key]['KETERANGAN'];
        $service =  $this->getServiceType($keterangan);
        $servicetype = $data[$key]['SERVICE_TYPE'].' '.$service;
                    //  print_r($data);die; 

                       $InsertData = array(
                            'BILLER_REQUEST_ID' => $data[$key]['ID_REQ'],
                            'TRX_NUMBER' => $data[$key]['ID_NOTA'],
                            'LINE_ID' => $key+1, 
                            'LINE_NUMBER' => $key+1,
                            'DESCRIPTION' => $data[$key]['KETERANGAN'],
                            'MEMO_LINE_ID' => '',  
                            'GL_REV_ID' => '',  
                            'LINE_CONTEXT' => '',  
                            'TAX_FLAG' => 'Y',  
                            'SERVICE_TYPE' =>  $servicetype,
                            'EAM_CODE' => '',
                            'LOCATION_TERMINAL' => '',  
                            'AMOUNT' =>  $data[$key]['SUB_TOTAL'],
                            'TAX_AMOUNT' => $data[$key]['PPN'], //'',
                            'START_DATE' => $data[$key]['CREATION_DATE'],
                            'END_DATE' => $data[$key]['LAST_UPDATED_DATE'],
                            'CREATED_BY' => '1',  
                            'CREATION_DATE' =>  $data[$key]['CREATION_DATE'],  
                            'LAST_UPDATED_BY' => '1',  
                            'LAST_UPDATED_DATE' => $data[$key]['LAST_UPDATED_DATE'],   
                            'INTERFACE_LINE_ATTRIBUTE1' => '',  
                            'INTERFACE_LINE_ATTRIBUTE2' => '', //$data[$key]['EI'],
                            'INTERFACE_LINE_ATTRIBUTE3' => '', // $data[$key]['OI'],
                            'INTERFACE_LINE_ATTRIBUTE4' => '', //$data[$key]['CRANE'],
                            'INTERFACE_LINE_ATTRIBUTE5' => '',//$data[$key]['JUMLAH_CONT'],  
                            'INTERFACE_LINE_ATTRIBUTE6' => '',//$data[$key]['HZ'], //$data[$key]['SIZE_TYPE_STAT_HAZ'], 
                            'INTERFACE_LINE_ATTRIBUTE7' => '',  
                            'INTERFACE_LINE_ATTRIBUTE8' => '',//$data[$key]['TARIF'],   
                            'INTERFACE_LINE_ATTRIBUTE9' => '',//$data[$key]['JUMLAH_HARI'], 
                            'INTERFACE_LINE_ATTRIBUTE10' => '',  
                            'INTERFACE_LINE_ATTRIBUTE11' => '',  
                            'INTERFACE_LINE_ATTRIBUTE12' => '',  
                            'INTERFACE_LINE_ATTRIBUTE13' => '',  
                            'INTERFACE_LINE_ATTRIBUTE14' => '',  
                            'INTERFACE_LINE_ATTRIBUTE15' => '',  
                        );
                        
                    //  print_r($InsertData);die;

                        return $InsertData;
    }
    
                    
    

    public function getOrgID(){
        $select='select ORG_ID from terminal_config where enable=\'Y\'';
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();
        $orgid = $result['ORG_ID'];
        return $orgid;
     }
              
    public function getTerminal(){
        $select='select TERMINAL_ID from terminal_config where enable=\'Y\'';
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();
        $id = $result['TERMINAL_ID'];
        return $id;
     }
           
    public function getServiceType($keterangan){
        $this->load->model('other_model');
        $select= 'SELECT KD_TP_JASA from MST_EBS_CFACCOUNT WHERE URAIAN_TP_JASA =\''.$keterangan.'\'';
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();
        $kode = $result['KD_TP_JASA'];
        return $kode;
     }
    public function getCustID($Cust_Name = null){
        // $this->load->model('other_model');
        // print_r($Cust_Name);die();
        $select='select KD_PELANGGAN from MST_PELANGGAN where NAMA_PERUSAHAAN =\''.$Cust_Name.'\'';
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();
        $kode = $result['KD_PELANGGAN'];
        return $kode;
     }
    public function getCustName($KD_PELANGGAN = null){
        // $this->load->model('other_model');
        // print_r($KD_PELANGGAN);die();
        $select='select NAMA_PERUSAHAAN from MST_PELANGGAN where KD_PELANGGAN =\''.$KD_PELANGGAN.'\'';
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();
        $kode = $result['NAMA_PERUSAHAAN'];
        return $kode;
     }
     public function getBankID($bank = null){
        // $this->load->model('other_model');
         // print_r($bank."-");die();
        $select='select * from MST_BANK_SIMKEU where BANK_ID =\''.$bank.'\'';
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();
        $kode = $result['BANK_ID'];
         // print_r($result);die();
        return $result;
     }
      
     public function getNota($jenis_nota, $swhere){
        $this->load->model('other_model');
        $swhere1 = ' where  A.STATUS=\'S\' AND A.ID_NOTA='.'\''.$swhere.'\'';
        $swhere2 = ' where   A.STATUS=\'S\' AND A.NO_NOTA='.'\''.$swhere.'\'';
        $select = '';

        if ($jenis_nota=='RECEIVING'){
        $select = 'select ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' LAYANAN, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL
                from nota_receiving_h A '.$swhere1;
        
        } elseif($jenis_nota=='DELIVERY'){
        $select = 'select ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                from nota_delivery_h A '.$swhere1;

        } elseif($jenis_nota=='BATAL MUAT'){
        $select = 'select NO_NOTA AS ID_NOTA, NO_FAKTUR, ID_BATALMUAT AS ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , \' \' AS VOYAGE_IN,
                VOYAGE AS VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                \'BATAL MUAT\' KET,\'BM\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h A '.$swhere2;
        
        } elseif($jenis_nota=='BEHANDLE'){
        $select = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL , \'\' AS VOYAGE_IN,
                VOYAGE AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                \'BEHANDLE\' KET,\'BH\'  KET_JENIS, PPN, NPWP , MATERAI, VAL from BH_NOTA A '.$swhere1;

        } elseif($jenis_nota=='EXMO'){            
        $select = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'EXMO\' KET, 
                \'EXMO\' KET_JENIS, PPN, NPWP, MATERAI, VAL     from EXMO_NOTA A '.$swhere1;

        } elseif($jenis_nota=='TRANSHIPMENT'){
        $select = 'select A.ID_NOTA, A.NO_FAKTUR, A.ID_REQUEST AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL AS VESSEL , 
                \'\' AS VOYAGE_IN,B.VOYAGE AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                \'XPTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET,\'TRANS\' KET_JENIS, A.PPN, A.NPWP , A.MATERAI , A.VAL 
                from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQUEST '.$swhere1;

        } elseif($jenis_nota=='REEXPORT'){  
        $select = 'select A.ID_NOTA, A.NO_FAKTUR, A.ID_REQUEST AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL AS VESSEL ,\' \' AS VOYAGE_IN,
                    B.VOYAGE AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'PTKM\' AS KD_MODUL, \'REEXPORT\' KET,
                    \'RXP\' KET_JENIS , A.PPN, A.NPWP , A.MATERAI, A.VAL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQUEST '.$swhere1;

        } elseif($jenis_nota=='STACKEXT'){
        $select ='select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, CUSTOMER NM_PEMILIK, STATUS, ALAMAT, VESSEL ,VOYAGE VOYAGE_IN, 
                    VOYAGE VOYAGE_OUT, TGL_CETAK TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTMK\' AS KD_MODUL, \'STACKEXT\' KET,\'STACKEXT\' KET_JENIS , PPN, NPWP , MATERAI, VAL
                    from NOTA_STACKEXT_H  A '.$swhere1;
                    
        } elseif($jenis_nota=='RNM'){
        $select = 'select ID_NOTA, NO_FAKTUR, NO_RENAME AS ID_REQ, PBM AS NM_PEMILIK, STATUS, ALAMAT, VESSEL ,\'\' AS  VOYAGE_IN, VOYAGE AS VOYAGE_OUT,
                    TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET, \'RNM\' KET_JENIS ,PPN, NPWP , MATERAI, VAL
                    from NOTA_RENAME_CONTAINER A '.$swhere1;

        } elseif($jenis_nota=='HICO'){
        $select = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL AS NM_PEMILIK, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                    NULL AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET, \'HICO\' KET_JENIS, PPN, NPWP  , MATERAI, VAL
                    from NOTA_  _H A '.$swhere1;
        }
        
        // print_r($select);die;
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        // $result = $query->result();
        $result = $query->row_array();
        return $result;
     } 
      
     public function getNotaD($jenis_nota, $swhere){
        $this->load->model('other_model');
        

        $swhere1 = ' where ID_NOTA='.'\''.$swhere.'\'';
        $swhere2 = ' where NO_NOTA='.'\''.$swhere.'\'';
        $select = '';

        if ($jenis_nota=='RECEIVING'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ, JUMLAH_HARI  from NOTA_RECEIVING_D ' .$swhere1;
        } elseif($jenis_nota=='DELIVERY'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ, JUMLAH_HARI  from NOTA_DELIVERY_D '.$swhere1;
        } elseif($jenis_nota=='BATAL MUAT'){
            $select = 'select NO_NOTA ID_NOTA, KETERANGAN, JUMLAH_HARI,TARIF,TOTAL SUB_TOTAL, (TOTAL*0.1) PPN, HZ, JUMLAH_HARI  from NOTA_BATALMUAT_D '.$swhere2;
        } elseif($jenis_nota=='BEHANDLE'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ,\'\' JUMLAH_HARI  from BH_DETAIL_NOTA '.$swhere1;
        } elseif($jenis_nota=='EXMO'){            
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ,\'\' JUMLAH_HARI  from EXMO_DETAIL_NOTA'.$swhere1;
        } elseif($jenis_nota=='TRANSHIPMENT'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ, JUMLAH_HARI  from NOTA_TRANSHIPMENT_D '.$swhere1;
        } elseif($jenis_nota=='REEXPORT'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ, JUMLAH_HARI  from NOTA_REEXPORT_D '.$swhere1;
        } elseif($jenis_nota=='STACKEXT'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ, JUMLAH_HARI  from NOTA_STACKEXT_D '.$swhere1;
        } elseif($jenis_nota=='RNM'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ,\'\' JUMLAH_HARI  from NOTA_RENAME_CONTAINER_D '.$swhere1;
        } elseif($jenis_nota=='HICO'){
            $select = 'select ID_NOTA, KETERANGAN,JUMLAH_CONT,TARIF,SUB_TOTAL, (SUB_TOTAL*0.1) PPN, HZ,\'\' JUMLAH_HARI  from NOTA_HICOSCAN_D '.$swhere1;
        }

        
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->result_array();
        // $result = $query->row_array();
        return $result;
     } 
        
    public function getPayment($swhere = null, $data = array()){
        // $swhere = array();
         $orgid =  json_decode($data['ORG_ID']);
         $unit_code = json_decode($data['UNIT_CODE']);
         // print_r($swhere);die();
       if($swhere!=null){
            if(intval($orgid[0]) == 84 || intval($orgid[0]) == 85 || intval($orgid[0]) == 83){
                $swhere1 = ' where  A.ID_PROFORMA='.'\''.$swhere.'\'';
                $swhere2 = ' where  A.ID_NOTA='.'\''.$swhere.'\'';

                /*print_r($where1);die(); */ 
            }else {
                $swhere1 = ' where  A.ID_NOTA='.'\''.$swhere.'\'';
                $swhere2 = ' where  A.NO_NOTA='.'\''.$swhere.'\'';
            }
            
        } else {
            $swhere1=' where A.STATUS=\'S\' ';
            $swhere2=' where A.STATUS=\'S\' ';
           
        }

        
        // die($swhere1);
        $searchArr = array();
        $this->db1 = $this->checkConection($data['ORG_ID']);
        
        if(intval($orgid[0]) == 88){
            
             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL
                     from nota_receiving_h A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                        TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                        from nota_delivery_h A '.$swhere1;    

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                        TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SPEP\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                        from nota_delivery_h_pen A '.$swhere1;      

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL ,VOYAGE_IN,
                        VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                        \'BATAL MUAT\' KET,\'BM\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h A '.$swhere2;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , VOYAGE_IN,
                        VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM16\' AS KD_MODUL,
                        \'BATAL MUAT\' KET,\'CPOD\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_changepod_h A '.$swhere2;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL ,VOYAGE_IN,
                        VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                        \'BATAL MUAT\' KET,\'BMP\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h_penumpukan A '.$swhere1;

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE_IN,
                        VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                        \'BEHANDLE\' KET,\'BH\' KET_JENIS, PPN, NPWP , MATERAI, VAL from NOTA_BEHANDLE_H A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                        TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM10\' AS KD_MODUL, \'EXMO\' KET, 
                        \'EXMO\' KET_JENIS, PPN, NPWP, MATERAI, VAL     from EXMO_NOTA A '.$swhere1;

             $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL , 
                        B.VOYAGE_IN_NEW AS VOYAGE_IN,B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                        \'PTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET,\'TRANS\' KET_JENIS, A.PPN, A.NPWP , A.MATERAI , VAL
                        from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1;

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL ,B.VOYAGE_IN_NEW AS VOYAGE_IN,
                        B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'PTKM\' AS KD_MODUL, \'REEXPORT\' KET,
                        \'RXP\' KET_JENIS , A.PPN, A.NPWP , A.MATERAI, A.VAL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1;
           
            
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, PELANGGAN AS EMKL, STATUS, ALAMAT, VESSEL ,\'\' AS  VOYAGE_IN, VOYAGE_OUT,
                        TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL,KD_PELANGGAN AS COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET, \'RNM\' KET_JENIS ,PPN, NPWP , MATERAI, VAL
                         from NOTA_RENAME_H A '.$swhere1;

            $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL AS EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                        VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET, \'HICO\' KET_JENIS, PPN, NPWP  , MATERAI, VAL
                        from NOTA_HICOSCAN_H A '.$swhere2;

        }else if(intval($orgid[0]) == 84){
            
             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL
                     from nota_receiving_h A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                        TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                        from nota_delivery_h A '.$swhere1;    

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                        TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SPEP\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                        from nota_delivery_h_pen A '.$swhere1;      

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL ,VOYAGE_IN,
                        VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                        \'BATAL MUAT\' KET,\'BM\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h A '.$swhere2;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , VOYAGE_IN,
                        VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM16\' AS KD_MODUL,
                        \'BATAL MUAT\' KET,\'CPOD\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_changepod_h A '.$swhere2;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL ,VOYAGE_IN,
                        VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                        \'BATAL MUAT\' KET,\'BMP\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h_penumpukan A '.$swhere1;

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE_IN,
                        VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                        \'BEHANDLE\' KET,\'BH\' KET_JENIS, PPN, NPWP , MATERAI, VAL from NOTA_BEHANDLE_H A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                        TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM10\' AS KD_MODUL, \'EXMO\' KET, 
                        \'EXMO\' KET_JENIS, PPN, NPWP, MATERAI, VAL     from EXMO_NOTA A '.$swhere1;

             $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL , 
                        B.VOYAGE_IN_NEW AS VOYAGE_IN,B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                        \'PTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET,\'TRANS\' KET_JENIS, A.PPN, A.NPWP , A.MATERAI , VAL
                        from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1;

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL ,B.VOYAGE_IN_NEW AS VOYAGE_IN,
                        B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'PTKM\' AS KD_MODUL, \'REEXPORT\' KET,
                        \'RXP\' KET_JENIS , A.PPN, A.NPWP , A.MATERAI, A.VAL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1;
           
            
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, PELANGGAN AS EMKL, STATUS, ALAMAT, VESSEL ,\'\' AS  VOYAGE_IN, VOYAGE_OUT,
                        TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL,KD_PELANGGAN AS COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET, \'RNM\' KET_JENIS ,PPN, NPWP , MATERAI, VAL
                         from NOTA_RENAME_H A '.$swhere1;

            $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL AS EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                        VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET, \'HICO\' KET_JENIS, PPN, NPWP  , MATERAI, VAL
                        from NOTA_HICOSCAN_H A '.$swhere2;

        }else if(intval($orgid[0]) == 85){
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL
                     from nota_receiving_h A '.$swhere1;
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                    from nota_delivery_h A '.$swhere1;
             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,ID_PROFORMA AS NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL
                     from nota_receiving_h A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,ID_PROFORMA AS NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI, VAL
                    from nota_delivery_h A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, ID_PROFORMA AS NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL_CODE , VOYAGE_IN,
                    VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                    \'BATAL MUAT\' KET,\'BM\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, ID_PROFORMA AS NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                    TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'EXMO\' KET, 
                    \'EXMO\' KET_JENIS, PPN, NPWP, MATERAI, VAL  from EXMO_NOTA A '.$swhere1;

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.ID_PROFORMA AS NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL , 
                    B.VOYAGE_IN_NEW AS VOYAGE_IN,B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                    \'XPTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET,\'TRANS\' KET_JENIS, A.PPN, A.NPWP , A.MATERAI , A.VAL 
                    from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1;
            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA,  A.ID_PROFORMA AS NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL ,B.VOYAGE_IN_NEW AS VOYAGE_IN,
                    B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'\' AS KD_MODUL, \'REEXPORT\' KET,
                    \'RXP\' KET_JENIS , A.PPN, A.NPWP , A.MATERAI, A.VAL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1;
        } else{
         $searchArr[] = 'select ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL
                     from nota_receiving_h A '.$swhere1;
        $searchArr[] = 'select ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI , VAL
                    from nota_delivery_h A '.$swhere1;            
        $searchArr[] = 'select NO_NOTA AS ID_NOTA, NO_FAKTUR, ID_BATALMUAT AS ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , \' \' AS VOYAGE_IN,
                    VOYAGE AS VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                    \'BATAL MUAT\' KET,\'BM\' KET_JENIS, PPN , NPWP , MATERAI, VAL from nota_batalmuat_h A '.$swhere2;
        $searchArr[] = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                    TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'EXMO\' KET, 
                    \'EXMO\' KET_JENIS, PPN, NPWP, MATERAI, VAL     from EXMO_NOTA A '.$swhere1;
        $searchArr[] = 'select A.ID_NOTA, A.NO_FAKTUR, A.ID_REQUEST AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL AS VESSEL ,\' \' AS VOYAGE_IN,
                    B.VOYAGE AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'PTKM\' AS KD_MODUL, \'REEXPORT\' KET,
                    \'RXP\' KET_JENIS , A.PPN, A.NPWP , A.MATERAI, A.VAL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQUEST '.$swhere1;
        $searchArr[] = 'select A.ID_NOTA, A.NO_FAKTUR, A.ID_REQUEST AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL AS VESSEL , 
                    \'\' AS VOYAGE_IN,B.VOYAGE AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                    \'XPTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET,\'TRANS\' KET_JENIS, A.PPN, A.NPWP , A.MATERAI , VAL
                    from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQUEST '.$swhere1;
        $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQ, EMKL AS NM_PEMILIK, STATUS,ALAMAT, VESSEL ,VOYAGE_IN,
                    VOYAGE_OUT, TGL_CETAK_NOTA AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM00\' AS KD_MODUL, \'RECEIVING\' KET, \'RELOAD\' KET_JENIS, PPN, NPWP  , MATERAI, VAL
                    from NOTA_RELOAD_H A '.$swhere1;
        $searchArr[] = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL , \'\' AS VOYAGE_IN,
                    VOYAGE AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                    \'BEHANDLE\' KET,\'BH\' KET_JENIS, PPN, NPWP , MATERAI, VAL from BH_NOTA A '.$swhere1;
        $searchArr[] = 'select ID_NOTA, NO_FAKTUR, NO_RENAME AS ID_REQ, PBM AS NM_PEMILIK, STATUS, ALAMAT, VESSEL ,\'\' AS  VOYAGE_IN, VOYAGE AS VOYAGE_OUT,
                    TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET, \'RNM\' KET_JENIS ,PPN, NPWP , MATERAI, VAL
                     from NOTA_RENAME_CONTAINER A '.$swhere1;
        $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL AS NM_PEMILIK, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                    NULL AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET, \'HICO\' KET_JENIS, PPN, NPWP  , MATERAI, VAL
                    from NOTA_HICOSCAN_H A '.$swhere1;
        
        }
                    
        


        /*$searchArr[] = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, CUSTOMER NM_PEMILIK, STATUS, ALAMAT, VESSEL ,VOYAGE VOYAGE_IN, 
                    VOYAGE VOYAGE_OUT, TGL_CETAK TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTMK\' AS KD_MODUL, \'STACKEXT\' KET,\'STACKEXT\' KET_JENIS , PPN, NPWP , MATERAI, VAL
                    from NOTA_STACKEXT_H  A '.$swhere1;*/
        
        



        // $select = $select1.' union '.$select2.' union '.$select3.' union '.$select4.' union '.$select5.' union '
        //          .$select6.' union '.$select7.' union '.$select8.' union '.$select9.' union '.$select10.' union '.$select11;

        $select = implode(" union ", $searchArr);
        // die($select);

        /*echo $select;die();*/
        $query = $this->db1->query($select);
        $result = $query->result();
        return $result;
    }

    function checkConection($prmORG){
        #ubah juga di bank_model_new
        $tempORg = json_decode($prmORG);
        if (empty($tempORg[0])) {
            $ORG_ID = $prmORG;
        } else {
            $ORG_ID = $tempORg[0];
        }
        if (intval($ORG_ID) == 89 || intval($ORG_ID) == 1827 ) {
           return $this->load->database('itos',true);
        } elseif (intval($ORG_ID) == 86 ) {
           return $this->load->database('nbs_tlb',true);
        } elseif (intval($ORG_ID) == 84 ) {
           return $this->load->database('nbs_pjg',true);
        } elseif (intval($ORG_ID) == 85 ) {
           return $this->load->database('nbs_plg',true);
         } elseif (intval($ORG_ID) == 88 ) {
           return $this->load->database('nbs_pnk',true);
        } else {
             $this->response( array('status'=>'failure', 
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));die();
        }

    }

    public function getPaymentSearch($data = null){
        // print_r($data['ID_REQ']);die();
        $orgid =  json_decode($data['ORG_ID']);
        $swhere1 = 'where A.STATUS=\'S\'';
        $swhere2 = 'where A.STATUS=\'S\'';
        $swhere3 = 'where A.STATUS=\'S\'';
        $swhere4 = '';
        $swhere11 = '';
        $swhereKDMODUL = '';
        $searchArr = array();
        if(isset($data['ID_NOTA'])){
            if($data['ID_NOTA']!=''){
                $swhere1 = $swhere1.' and A.ID_NOTA like \'%'.$data['ID_NOTA'].'%\'' ;
                $swhere2 = $swhere2.' and A.NO_NOTA like \'%'.$data['ID_NOTA'].'%\'';
                $swhere3 = $swhere3.' and A.ID_NOTA like \'%'.$data['ID_NOTA'].'%\'';

            }
        }
        if(!empty($data['KD_MODUL'])){
            $swhereKDMODUL = " where KD_MODUL = '".$data['KD_MODUL']."'";
        }
        // if(!empty($data['ID_REQ'])){
        //     // print_r($data['ID_REQ']."nnnnnnnn");die;
        //     $swhere11 = $swhere1;
        //     $swhere1 = $swhere11.' and A.ID_REQ like \'%'.$data['ID_REQ'].'%\'';
        //     $swhere2 = $swhere2.' and A.ID_BATALMUAT like \'%'.$data['ID_REQ'].'%\''; 
        //     $swhere3 = $swhere11.' and A.ID_REQUEST like \'%'.$data['ID_REQ'].'%\''; 
        //     $swhere4 = $swhere11.' and A.NO_RENAME like \'%'.$data['ID_REQ'].'%\''; 
        // }
        if(isset($data['ID_REQ'])){
            if($data['ID_REQ']!=''){
                $swhere11 = $swhere1;
                $swhere1 = $swhere11.' and A.ID_REQ like \'%'.$data['ID_REQ'].'%\'';
                $swhere2 = $swhere2.' and A.ID_BATALMUAT like \'%'.$data['ID_REQ'].'%\''; 
                $swhere3 = $swhere11.' and A.ID_REQUEST like \'%'.$data['ID_REQ'].'%\''; 
                $swhere4 = $swhere11.' and A.NO_RENAME like \'%'.$data['ID_REQ'].'%\''; 
            }
        }
        /*if(intval($orgid[0]) == 85){
            $where1 = $where1." and A.TERMINAL_ID = 'PLM'";
        }*/
        // print_r($where3);die();
        // if($data['LAYANAN']!=''){
        //         $slayanan = $data['LAYANAN'];
        //         if ($slayanan='All') $slayanan ='';
        //         $swhere1 = $swhere1.' and A.LAYANAN like \'%'.$slayanan.'%\'';
        //         $swhere2 = $swhere2.' and A.LAYANAN like \'%'.$slayanan.'%\'';            
        // }
        // if($data['KD_MODUL']!=''){
        //         $modul = $data['KD_MODUL'];
        //         if ($modul=='All') $modul ='';
        //         $swhere1 = $swhere1.' and A.KD_MODUL like \'%'.$modul.'%\'';
        //         $swhere2 = $swhere2.' and A.JENIS like \'%'.$modul.'%\'';            
        // }
        
        // die($swhere3."dddddddddd");

        $this->db1 = $this->checkConection($data['ORG_ID']);
        
        if(intval($orgid[0]) == 88){
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET_JENIS, \'ANNE\' KET, PPN , NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL
                     from nota_receiving_h A '.$swhere1." and TERMINAL_ID = 'PJG'";
            
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET_JENIS, \'SP2\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from nota_delivery_h A '.$swhere1." and TERMINAL_ID = 'PJG'";

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , VOYAGE_IN,
                    VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                    \'BATAL MUAT\' KET_JENIS,\'BM\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL from nota_batalmuat_h A '.$swhere1." and TERMINAL_ID = 'PJG'";
                           
             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                    TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'EXMO\' KET_JENIS, 
                    \'EXMO\' KET, PPN, NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL    from EXMO_NOTA A '.$swhere3." and TERMINAL_ID = 'PJG'";

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL , 
                    B.VOYAGE_IN_NEW AS VOYAGE_IN,B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                    \'XPTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET_JENIS,\'TRANS\' KET, A.PPN, A.NPWP , A.MATERAI , A.VAL, \'PETIKEMAS\' MODUL 
                    from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1." and A.TERMINAL_ID = 'PJG'";

             $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL ,B.VOYAGE_IN_NEW AS VOYAGE_IN,
                    B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'\' AS KD_MODUL, \'REEXPORT\' KET_JENIS,
                    \'RXP\' KET , A.PPN, A.NPWP , A.MATERAI, A.VAL, \'PETIKEMAS\' MODUL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1." and A.TERMINAL_ID = 'PJG'";

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL , VOYAGE_IN,
                    VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                    \'BEHANDLE\' KET_JENIS, \'BH\' KET, PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL    from NOTA_BEHANDLE_H A '.$swhere3." and TERMINAL_ID = 'PJG'";
        

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR,ID_REQ, PELANGGAN AS EMKL, STATUS, ALAMAT, VESSEL , VOYAGE_IN, VOYAGE_OUT,
                        TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, KD_PELANGGAN AS COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET_JENIS, \'RNM\' KET ,PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL
                         from NOTA_RENAME_H A '.$swhere1." and A.TERMINAL_ID = 'PJG'";

            $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                        NULL AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET_JENIS, \'HICO\' KET, PPN, NPWP  , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                        from NOTA_HICOSCAN_H A '.$swhere3;


        }else if(intval($orgid[0]) == 84){
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' KET_JENIS, \'ANNE\' KET, PPN , NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL
                     from nota_receiving_h A '.$swhere1." and TERMINAL_ID = 'PJG'";
            
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET_JENIS, \'SP2\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from nota_delivery_h A '.$swhere1." and TERMINAL_ID = 'PJG'";

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , VOYAGE_IN,
                    VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                    \'BATAL MUAT\' KET_JENIS,\'BM\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL from nota_batalmuat_h A '.$swhere1." and TERMINAL_ID = 'PJG'";
                           
             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                    TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'EXMO\' KET_JENIS, 
                    \'EXMO\' KET, PPN, NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL    from EXMO_NOTA A '.$swhere3." and TERMINAL_ID = 'PJG'";

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL , 
                    B.VOYAGE_IN_NEW AS VOYAGE_IN,B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                    \'XPTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET_JENIS,\'TRANS\' KET, A.PPN, A.NPWP , A.MATERAI , A.VAL, \'PETIKEMAS\' MODUL 
                    from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1." and A.TERMINAL_ID = 'PJG'";

             $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL ,B.VOYAGE_IN_NEW AS VOYAGE_IN,
                    B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'\' AS KD_MODUL, \'REEXPORT\' KET_JENIS,
                    \'RXP\' KET , A.PPN, A.NPWP , A.MATERAI, A.VAL, \'PETIKEMAS\' MODUL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1." and A.TERMINAL_ID = 'PJG'";

             $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL , VOYAGE_IN,
                    VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                    \'BEHANDLE\' KET_JENIS, \'BH\' KET, PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL    from NOTA_BEHANDLE_H A '.$swhere3." and TERMINAL_ID = 'PJG'";
        

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR,ID_REQ, PELANGGAN AS EMKL, STATUS, ALAMAT, VESSEL , VOYAGE_IN, VOYAGE_OUT,
                        TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, KD_PELANGGAN AS COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET_JENIS, \'RNM\' KET ,PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL
                         from NOTA_RENAME_H A '.$swhere1." and A.TERMINAL_ID = 'PJG'";

            $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                        NULL AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET_JENIS, \'HICO\' KET, PPN, NPWP  , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                        from NOTA_HICOSCAN_H A '.$swhere3;


        }else if(intval($orgid[0]) == 85){
    
            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,\'PTKM00\' KD_MODUL,\'RECEIVING\' KET_JENIS, \'ANNE\' KET, PPN , NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL 
                     from nota_receiving_h A '.$swhere1 ." and TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,\'PTKM07\' KD_MODUL, \'DELIVERY\' KET_JENIS, \'SP2\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from nota_delivery_h A '.$swhere1 ." and TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,\'PTKM01\' KD_MODUL, \'DELIVERY LOLO\' KET_JENIS, \'\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from nota_delivery_lolo_h A '.$swhere1 ." and TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA,  NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,\'\' KD_MODUL, \'DELIVERY PENUMPUKAN\' KET_JENIS, \'\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from nota_delivery_h_pen A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL_CODE , VOYAGE_IN,
                    VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                    \'BATAL MUAT\' KET_JENIS,\'BM\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL  from nota_batalmuat_h A '.$swhere1 ."and TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL_CODE , VOYAGE_IN,
                    VOYAGE_OUT, sysdate AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'\' KD_MODUL,
                    \'BATAL MUAT PENUMPUKAN\' KET_JENIS,\'BM\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL  from nota_batalmuat_h_penumpukan A '.$swhere1;

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT_EMKL, VESSEL_CODE , VOYAGE_IN,
                    VOYAGE_OUT, sysdate AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' KD_MODUL,
                    \'BEHANDLE\' KET_JENIS,\'BH\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL  from nota_behandle_h A '.$swhere1 ."and TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select ID_PROFORMA AS  ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                    TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM10\' AS KD_MODUL, \'EXMO\' KET_JENIS, 
                    \'EXMO\' KET, PPN, NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL  from EXMO_NOTA A '.$swhere1 ." and A.TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA, NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL , 
                    B.VOYAGE_IN_NEW AS VOYAGE_IN,B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                    \'PTKM15\' AS KD_MODUL, \'TRANSHIPMENT\' KET_JENIS,\'TRANS\' KET, A.PPN, A.NPWP , A.MATERAI , A.VAL , \'PETIKEMAS\' MODUL 
                    from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1 ." and A.TERMINAL_ID = 'PLM'";

            $searchArr[] = 'select A.ID_PROFORMA AS ID_NOTA,  A.NO_FAKTUR, A.ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL_NEW AS VESSEL ,B.VOYAGE_IN_NEW AS VOYAGE_IN,
                    B.VOYAGE_OUT_NEW AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'PTKM15\' AS KD_MODUL, \'REEXPORT\' KET_JENIS,
                    \'RXP\' KET , A.PPN, A.NPWP , A.MATERAI, A.VAL, \'PETIKEMAS\' MODUL  from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQ '.$swhere1 ." and A.TERMINAL_ID = 'PLM'"; 

            $searchArr[] = 'select ID_PROFORMA AS ID_NOTA, NO_FAKTUR, ID_REQ, PELANGGAN, STATUS, ALAMAT, VESSEL_CODE , VOYAGE_IN,
                    VOYAGE_OUT, sysdate AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, KD_PELANGGAN AS COA, \'PTKM11\' KD_MODUL,
                    \'RENAME\' KET_JENIS,\'BM\' KET, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL  from NOTA_RENAME_H A '.$swhere1 ."and TERMINAL_ID = 'PLM'";      
        }else{
            $searchArr[] = 'select ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS,ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                     TGL_PAYMENT, PAYMENT_VIA,TOTAL,COA,KD_MODUL,\'RECEIVING\' LAYANAN, \'ANNE\' KET_JENIS, PPN , NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL
                     from nota_receiving_h A '.$swhere1;
            $searchArr[] = 'select ID_NOTA,NO_FAKTUR, ID_REQ, EMKL, STATUS, ALAMAT, VESSEL, VOYAGE_IN, VOYAGE_OUT,sysdate as TGL_SIMPAN,
                    TGL_PAYMENT, PAYMENT_VIA, TOTAL,COA,KD_MODUL, \'DELIVERY\' KET, \'SP2\' KET_JENIS, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from nota_delivery_h A '.$swhere1;
             $searchArr[] = 'select NO_NOTA AS ID_NOTA, NO_FAKTUR, ID_BATALMUAT AS ID_REQ, EMKL, STATUS, ALAMAT, VESSEL , \' \' AS VOYAGE_IN,
                    VOYAGE AS VOYAGE_OUT, TGL_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, BAYAR AS TOTAL, COA, \'PTKM08\' AS KD_MODUL,
                    \'BATAL MUAT\' KET_JENIS,\'BM\' KET_JENIS, PPN , NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL from nota_batalmuat_h A '.$swhere2;

             $searchArr[] = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT, \'\' AS VESSEL , \' \' AS VOYAGE_IN, \' \' AS VOYAGE_OUT,
                    TGL_CETAK_NOTA AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'EXMO\' KET, 
                    \'EXMO\' KET_JENIS, PPN, NPWP, MATERAI, VAL, \'PETIKEMAS\' MODUL    from EXMO_NOTA A '.$swhere3;

             $searchArr[] = 'select A.ID_NOTA, A.NO_FAKTUR, A.ID_REQUEST AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL AS VESSEL ,\' \' AS VOYAGE_IN,
                    B.VOYAGE AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA, \'\' AS KD_MODUL, \'REEXPORT\' KET_JENIS,
                    \'RXP\' KET , A.PPN, A.NPWP , A.MATERAI, A.VAL, \'PETIKEMAS\' MODUL from NOTA_REEXPORT_H A LEFT JOIN REQ_REEXPORT_H B ON B.ID_REQ=A.ID_REQUEST '.$swhere3;

            $searchArr[] = 'select A.ID_NOTA, A.NO_FAKTUR, A.ID_REQUEST AS ID_REQ, A.CUSTOMER AS EMKL, A.STATUS, A.ALAMAT, B.VESSEL AS VESSEL , 
                    \'\' AS VOYAGE_IN,B.VOYAGE AS VOYAGE_OUT, A.TGL_CETAK AS TGL_SIMPAN,A.TGL_PAYMENT, A.PAYMENT_VIA, A.TOTAL, A.COA,
                    \'XPTKM13\' AS KD_MODUL, \'TRANSHIPMENT\' KET_JENIS,\'TRANS\' KET, A.PPN, A.NPWP , A.MATERAI , A.VAL, \'PETIKEMAS\' MODUL 
                    from NOTA_TRANSHIPMENT_H A LEFT JOIN REQ_TRANSHIPMENT_H B ON B.ID_REQ=A.ID_REQUEST '.$swhere3;

            $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQ, EMKL AS NM_PEMILIK, STATUS,ALAMAT, VESSEL ,VOYAGE_IN,
                    VOYAGE_OUT, TGL_CETAK_NOTA AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA,KD_MODUL, \'RECEIVING\' KET_JENIS, \'RELOAD\' KET, PPN, NPWP  , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from NOTA_RELOAD_H A '.$swhere3;
             $searchArr[] = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, EMKL, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL , \'\' AS VOYAGE_IN,
                    VOYAGE AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM05\' AS KD_MODUL,
                    \'BEHANDLE\' KET_JENIS, \'BH\' KET, PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL    from BH_NOTA A '.$swhere3;
        
        
        // $searchArr[] = 'select ID_NOTA, NO_FAKTUR, ID_REQUEST AS ID_REQ, CUSTOMER NM_PEMILIK, STATUS, ALAMAT, VESSEL ,VOYAGE VOYAGE_IN, 
        //             VOYAGE VOYAGE_OUT, TGL_CETAK TGL_SIMPAN,TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'STACKEXT\' KET,\'STACKEXT\' KET_JENIS , PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL
        //             from NOTA_STACKEXT_H  A '.$swhere3;
        $searchArr[] = 'select ID_NOTA, NO_FAKTUR, NO_RENAME AS ID_REQ, PBM AS NM_PEMILIK, STATUS, ALAMAT, VESSEL ,\'\' AS  VOYAGE_IN, VOYAGE AS VOYAGE_OUT,
                    TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'PTKM\' AS KD_MODUL, \'RNM\' KET_JENIS, \'RNM\' KET ,PPN, NPWP , MATERAI, VAL, \'PETIKEMAS\' MODUL
                     from NOTA_RENAME_CONTAINER A '.$swhere4;
        $searchArr[] = 'select ID_NOTA,ID_NOTA AS NO_FAKTUR ,ID_REQUEST AS ID_REQ, EMKL AS NM_PEMILIK, STATUS, ALAMAT_EMKL AS ALAMAT, VESSEL ,VOYAGE AS VOYAGE_IN,
                    NULL AS VOYAGE_OUT, TGL_CETAK AS TGL_SIMPAN, TGL_PAYMENT, PAYMENT_VIA, TOTAL, COA, \'XPTKM12\' AS KD_MODUL, \'HICO\' KET_JENIS, \'HICO\' KET, PPN, NPWP  , MATERAI, VAL, \'PETIKEMAS\' MODUL 
                    from NOTA_HICOSCAN_H A '.$swhere3;
        }
       
       


        // $select = $select1.' union '.$select2.' union '.$select3.' union '.$select4.' union '.$select5.' union '
                 // .$select6.' union '.$select7.' union '.$select8.' union '.$select9.' union '.$select10;
        $select = implode(" union ", $searchArr);
        // die($select);
        $query = $this->db1->query(
                                    "select * from (".$select.") ".$swhereKDMODUL."order by TGL_SIMPAN desc");

        $result = $query->result();
        return $result;
    }
    public function getshipper($data = null)
    {
        // print_r($data['ID_REQ']);die;
        $swhere1 ='';
        $swhere2 ='';
        $swhere3 ='';
        $searchArr = array();
        if(!empty($data['ID_REQ'])){
            // if($data['ID_REQ']!=''){
                $swhere1 = "where A.ID_REQ = '".$data['ID_REQ']."'" ;
                $swhere2 = "where A.ID_REQUEST = '".$data['ID_REQ']."'";
                $swhere3 = "where A.ID_BATALMUAT = '".$data['ID_REQ']."'";

            // }
        }
        $this->db1 = $this->load->database('itos',true);
        $searchArr[] = 'SELECT NAMA_SHIPPER from REQ_RECEIVING_H A '.$swhere1; //where trim(ID_REQ)='".$data[KD_PERMINTAAN]."'")';
        $searchArr[] = 'SELECT NAMA_SHIPPER from REQ_DELIVERY_h A '.$swhere1; //where trim(ID_REQ)='".$data[KD_PERMINTAAN]."'")';
        $searchArr[] = 'SELECT NAMA_SHIPPER from BH_REQUEST A '.$swhere2; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'")';
        $searchArr[] = 'SELECT NAMA_SHIPPER from TB_BATALMUAT_H A '.$swhere3; //where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN].$searchArr[] = '"'")';
        $searchArr[] = 'SELECT SHIPPING_LINE AS NAMA_SHIPPER from REQ_RELOAD_H A '.$swhere1; //where trim(ID_REQ)='".$data[KD_PERMINTAAN]."'")';
        // $searchArr[] = 'select TGL_REQ from EXMO_REQUEST A '.$swhere2; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'")';
        $select = implode(" union ", $searchArr);
        // die($select);
        $query = $this->db1->query("select * from (".$select.")");
        $result = $query->result();
        return $result;
        // print_r($result);
    }

   
 // public function getcontainer($data = null){
 //        $swhere1 ='';
 //        $swhere2 ='';
 //        $swhere3 ='';
 //        $swhere4 ='';
 //        $searchArr = array();
 //        if(!empty($data['ID_REQ'])){
 //                $swhere1 = "where A.ID_REQUEST = '".$data['ID_REQ']."'" ;
 //                $swhere2 = "where A.NO_REQ_ANNE = '".$data['ID_REQ']."'";
 //                $swhere3 = "where A.ID_BATALMUAT = '".$data['ID_REQ']."'";
 //                $swhere4 = "where A.NO_REQ_DEV = '".$data['ID_REQ']."'";
 //                $swhere5 = "where A.NO_REQ_REL = '".$data['ID_REQ']."'";
 //        }
 //        $this->db1 = $this->load->database('itos',true);
 //        // $searchArr[] = 'SELECT A.NO_CONTAINER,(SELECT REGEXP_SUBSTR ((SELECT JNS_CONT A FROM BH_DETAIL_REQUEST A '.$where1.'), '[^-]+', 1, 1)SZ
 //        //     FROM dual),(SELECT REGEXP_SUBSTR ((SELECT JNS_CONT A FROM BH_DETAIL_REQUEST A '.$where1.'), '[^-]+', 1, 2)TY
 //        //     FROM dual),(SELECT REGEXP_SUBSTR ((SELECT JNS_CONT A FROM BH_DETAIL_REQUEST A '.$where1.'), '[^-]+', 1, 3)ST
 //        //     FROM dual),HAZZARD AS HZ from BH_DETAIL_REQUEST A '.$swhere1;  // WHERE ID_NOTA='$p1' group by NO_CONTAINER';
 //        $searchArr[] = "SELECT A.NO_CONTAINER,(SELECT REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 1)SZ
 //            FROM dual) SZ,(SELECT REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 2)TY
 //            FROM dual) TY,(SELECT REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 3)ST
 //            FROM dual) ST,A.HAZZARD AS HZ from BH_DETAIL_REQUEST A ".$swhere1;
 //        $searchArr[] = "SELECT A.NO_CONTAINER,A.SIZE_CONT AS SZ,A.TYPE_CONT AS TY,A.STATUS_CONT AS ST,A.HZ
 //                         from REQ_RECEIVING_D A ".$swhere2;  // where trim(NO_REQ_ANNE)='".$data[KD_PERMINTAAN]."'';
 //        $searchArr[] = "SELECT A.NO_CONTAINER,(SELECT REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere3."), '[^-]+', 1, 1)SZ FROM dual) SZ,(SELECT REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere3."), '[^-]+', 1, 2)TY FROM dual) TY,A.STATUS AS ST,A.HZ
 //                         from TB_BATALMUAT_D A  ".$swhere3;  // where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN]."'';
 //        $searchArr[] = "SELECT A.NO_CONTAINER,A.SIZE_CONT AS SZ,A.TYPE_CONT AS TY,A.STATUS_CONT AS ST,A.HZ
 //                         from REQ_DELIVERY_D A ".$swhere4;  // where trim(NO_REQ_DEV)='".$data[KD_PERMINTAAN]."'';
 //        // $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
 //                         //from EXMO_DETAIL_REQUEST A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'';
 //        $searchArr[] = 'SELECT A.NO_CONTAINER,A.SIZE_CONT AS SZ,A.TYPE_CONT AS TY,A.STATUS_CONT AS ST,A.HZ
 //                         from REQ_RELOAD_D A '.$swhere5;  // where trim(NO_REQ_REL)='".$data[KD_PERMINTAAN]."'';
        
 //        $select = implode(" union ", $searchArr);
 //        // die($select);
 //        $query = $this->db1->query("select * from (".$select.")");
 //        $result = $query->result();
 //        return $result;
 //    }
    public function getcontainerxx($data = null){
        $swhere1 ='';
        $swhere2 ='';
        $swhere3 ='';
        $swhere4 ='';
        $searchArr = array();
        if(!empty($data['ID_REQ'])){
                $swhere1 = "where A.ID_REQUEST = '".$data['ID_REQ']."'" ;
                $swhere2 = "where A.NO_REQ_ANNE = '".$data['ID_REQ']."'";
                $swhere3 = "where A.ID_BATALMUAT = '".$data['ID_REQ']."'";
                $swhere4 = "where A.NO_REQ_DEV = '".$data['ID_REQ']."'";
                $swhere5 = "where A.NO_REQ_REL = '".$data['ID_REQ']."'";
        }
        $this->db1 = $this->load->database('itos',true);
        //Receiving
        $searchArr[] = 'SELECT A.NO_CONTAINER
                         from REQ_RECEIVING_D A '.$swhere2;  // where trim(NO_REQ_ANNE)='".$data[KD_PERMINTAAN]."'';
        //Reload
         $searchArr[] = 'SELECT A.NO_CONTAINER A
                         from REQ_RELOAD_D A '.$swhere5;  // where trim(NO_REQ_REL)='".$data[KD_PERMINTAAN]."'';
        //SEE
        $searchArr[] = 'SELECT A.NO_CONTAINER,A.SIZE_,A.TYPE_,A.STATUS_,A.HZ FROM LIST_SEE '.$WHERE1;//WHERE ID_REQ =//   
        
        //BEHANDLE 
        $searchArr[] = 'SELECT A.NO_CONTAINER
                         from BH_DETAIL_REQUEST A '.$swhere1;//INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1;  // WHERE ID_NOTA='$p1' group by NO_CONTAINER';
       //Batal Muat
        $searchArr[] = 'SELECT A.NO_CONTAINER
                         from TB_BATALMUAT_D A '.$swhere3;  // where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN]."'';
       //Delivery 
        $searchArr[] = 'SELECT A.NO_CONTAINER
                         from REQ_DELIVERY_D A '.$swhere4;//INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere4;  // where trim(NO_REQ_DEV)='".$data[KD_PERMINTAAN]."'';
        // $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
                         //from EXMO_DETAIL_REQUEST A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'';
        $select = implode(" union ", $searchArr);
        // die($select);
        $query = $this->db1->query("select * from (".$select.")");
        $result = $query->result();
        return $result;
    }
    public function getcontainer_old($data = null){
       $swhere1 ='';
        $swhere2 ='';
        $swhere3 ='';
        $swhere4 ='';
        $swhere5 ='';
        $swhere6 ='';
        $searchArr = array();
        if(!empty($data['ID_REQ'])){
                $swhere1 = "where A.ID_REQUEST = '".$data['ID_REQ']."'" ;
                $swhere2 = "where C.NO_REQ_ANNE = '".$data['ID_REQ']."'";
                $swhere3 = "where D.ID_BATALMUAT = '".$data['ID_REQ']."'";
                $swhere4 = "where E.NO_REQ_DEV = '".$data['ID_REQ']."'";
                $swhere5 = "where B.NO_REQ_REL = '".$data['ID_REQ']."'";
                $swhere6 = "where F.ID_REQ = '".$data['ID_REQ']."'";
        }
        $this->db1 = $this->load->database('itos',true);
        //RECEIVING
        $searchArr[] = "SELECT C.NO_CONTAINER,TO_CHAR(C.SIZE_CONT) AS SZ,C.TYPE_CONT AS TY,C.STATUS_CONT AS ST,C.HZ
                         from REQ_RECEIVING_D C ".$swhere2;  // where trim(NO_REQ_ANNE)='".$data[KD_PERMINTAAN]."'';
        //RELOAD
        $searchArr[] = "SELECT B.NO_CONTAINER,TO_CHAR(B.SIZE_CONT) SZ,B.TYPE_CONT TY,B.STATUS_CONT ST,B.HZ
                         from REQ_RELOAD_D B ".$swhere5;  // where trim(NO_REQ_REL)='".$data[KD_PERMINTAAN]."'';
        //SEE
        $searchArr[] = "SELECT F.NO_CONTAINER,TO_CHAR(F.SIZE_) SZ,F.TYPE_ TY,F.STATUS_ ST,F.HZ FROM LIST_SEE F ".$swhere6;//WHERE ID_REQ =//   
        //BH                                
        $searchArr[] = "SELECT A.NO_CONTAINER,
            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 1)) SZ FROM dual) SZ,
            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 2)) TY FROM dual) TY,
            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 3)) ST FROM dual) ST,
            A.HAZZARD AS HZ from BH_DETAIL_REQUEST A ".$swhere1;
        //Batal Muat
        $searchArr[] = "SELECT D.NO_CONTAINER,
            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT D.JNS_CONT FROM TB_BATALMUAT_D D ".$swhere3."), '[^-]+', 1, 1)) SZ FROM dual) SZ,
            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT D.JNS_CONT FROM TB_BATALMUAT_D D ".$swhere3."), '[^-]+', 1, 2)) TY FROM dual) TY,
            D.STATUS AS ST,D.HZ
                         from TB_BATALMUAT_D D  ".$swhere3;  // where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN]."'';
        //DELIVERY
        $searchArr[] = "SELECT E.NO_CONTAINER,TO_CHAR(E.SIZE_CONT) AS SZ,E.TYPE_CONT AS TY,E.STATUS_CONT AS ST,E.HZ
                         from REQ_DELIVERY_D E ".$swhere4;  // where trim(NO_REQ_DEV)='".$data[KD_PERMINTAAN]."'';
        // $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
                         //from EXMO_DETAIL_REQUEST A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'';
        
        
        $select = implode(" union ", $searchArr);
        die($select);
        $query = $this->db1->query("select * from (".$select.")");
        $result = $query->result();
        return $result;
    }
    public function getcontainer($data = null){
       $swhere1 ='';
        $swhere2 ='';
        $swhere3 ='';
        $swhere4 ='';
        $swhere5 ='';
        $swhere6 ='';
        $searchArr = array();
        if(!empty($data['ID_REQ'])){
                $swhere1 = "where A.ID_REQUEST = '".$data['ID_REQ']."'" ;
                $swhere2 = "where C.NO_REQ_ANNE = '".$data['ID_REQ']."'";
                $swhere3 = "where D.ID_BATALMUAT = '".$data['ID_REQ']."'";
                $swhere4 = "where E.NO_REQ_DEV = '".$data['ID_REQ']."'";
                $swhere5 = "where B.NO_REQ_REL = '".$data['ID_REQ']."'";
                $swhere6 = "where F.ID_REQ = '".$data['ID_REQ']."'";
        }
        $this->db1 = $this->load->database('itos',true);
        //RECEIVING
        $searchArr[] = "SELECT C.NO_CONTAINER,TO_CHAR(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(
                      CONCAT(C.SIZE_CONT,'-')
                      ,C.TYPE_CONT)
                      ,'-')
                      ,C.STATUS_CONT)
                      ,'-')
                      ,C.HZ)) AS LIST_CONT
                         from REQ_RECEIVING_D C ".$swhere2;  // where trim(NO_REQ_ANNE)='".$data[KD_PERMINTAAN]."'';
        //RELOAD
        $searchArr[] = "SELECT B.NO_CONTAINER,TO_CHAR(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(
                      CONCAT(B.SIZE_CONT,'-')
                      ,B.TYPE_CONT)
                      ,'-')
                      ,B.STATUS_CONT)
                      ,'-')
                      ,B.HZ)) AS LIST_CONT
                         from REQ_RELOAD_D B ".$swhere5;  // where trim(NO_REQ_REL)='".$data[KD_PERMINTAAN]."'';
        //SEE
        $searchArr[] = "SELECT F.NO_CONTAINER,CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(
                      CONCAT(F.SIZE_,'-')
                      ,F.TYPE_)
                      ,'-')
                      ,F.STATUS_)
                      ,'-')
                      ,F.HZ) AS LIST_CONT FROM LIST_SEE F ".$swhere6;//WHERE ID_REQ =//   
        //BH                                
        $searchArr[] = "SELECT A.NO_CONTAINER,TO_CHAR(CONCAT(CONCAT(A.JNS_CONT,'-'),A.HAZZARD)) LIST_CONT from BH_DETAIL_REQUEST A ".$swhere1;
        //Batal Muat
        $searchArr[] = "SELECT D.NO_CONTAINER,CONCAT(CONCAT(D.JNS_CONT,'-'),D.HZ) AS LIST_CONT
                         from TB_BATALMUAT_D D  ".$swhere3;  // where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN]."'';
        //DELIVERY
        $searchArr[] = "SELECT E.NO_CONTAINER,TO_CHAR(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(
                      CONCAT(E.SIZE_CONT,'-'),E.TYPE_CONT),'-'),E.STATUS_CONT),'-'),E.HZ)) AS LIST_CONT
                         from REQ_DELIVERY_D E ".$swhere4;  // where trim(NO_REQ_DEV)='".$data[KD_PERMINTAAN]."'';
        // $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
                         //from EXMO_DETAIL_REQUEST A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'';
        
        
        $select = implode(" union ", $searchArr);
        // die($select);
        $query = $this->db1->query("select * from (".$select.")");
        $result = $query->result();
        return $result;
    }
        //DELIVERY

    // public function getcontainer($data = null){
    //     $swhere1 ='';
    //     $swhere2 ='';
    //     $swhere3 ='';
    //     $swhere4 ='';
    //     $searchArr = array();
    //     if(!empty($data['ID_REQ'])){
    //             $swhere1 = "where A.ID_REQUEST = '".$data['ID_REQ']."'" ;
    //             $swhere2 = "where A.NO_REQ_ANNE = '".$data['ID_REQ']."'";
    //             $swhere3 = "where A.ID_BATALMUAT = '".$data['ID_REQ']."'";
    //             $swhere4 = "where A.NO_REQ_DEV = '".$data['ID_REQ']."'";
    //             $swhere5 = "where A.NO_REQ_REL = '".$data['ID_REQ']."'";
    //     }
    //     $this->db1 = $this->load->database('itos',true);
    //     $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
    //                      from BH_DETAIL_NOTA A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1;  // WHERE ID_NOTA='$p1' group by NO_CONTAINER';
    //     $searchArr[] = 'SELECT A.NO_CONTAINER,NO_CONTAINER,A.SIZE_CONT,A.TYPE_CONT,A.STATUS_CONT,A.HZ
    //                      from REQ_RECEIVING_D A '.$swhere2;  // where trim(NO_REQ_ANNE)='".$data[KD_PERMINTAAN]."'';
    //     $searchArr[] = 'SELECT A.NO_CONTAINER,A.STATUS,A.HZ,A.JNS_CONT
    //                      from TB_BATALMUAT_D A  '.$swhere3;  // where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN]."'';
    //     $searchArr[] = 'SELECT A.NO_CONTAINER,A.SIZE_CONT,A.TYPE_CONT,A.STATUS_CONT,A.HZ
    //                      from REQ_DELIVERY_D A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere4;  // where trim(NO_REQ_DEV)='".$data[KD_PERMINTAAN]."'';
    //     // $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
    //                      //from EXMO_DETAIL_REQUEST A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'';
    //     $searchArr[] = 'SELECT A.NO_CONTAINER,A.SIZE_CONT,A.TYPE_CONT,A.STATUS_CONT,A.HZ
    //                      from REQ_RELOAD_D A '.$swhere5;  // where trim(NO_REQ_REL)='".$data[KD_PERMINTAAN]."'';
        
    //     $select = implode(" union ", $searchArr);
    //     die($select);
    //     $query = $this->db1->query("select * from (".$select.")");
    //     $result = $query->result();
    //     return $result;
    // }
 // public function getcontainer($data = null){
 //        $swhere1 ='';
 //        $swhere2 ='';
 //        $swhere3 ='';
 //        $swhere4 ='';
 //        $searchArr = array();
 //        if(!empty($data['ID_REQ'])){
 //                $swhere1 = "where A.ID_REQUEST = '".$data['ID_REQ']."'" ;
 //                $swhere2 = "where C.NO_REQ_ANNE = '".$data['ID_REQ']."'";
 //                $swhere3 = "where D.ID_BATALMUAT = '".$data['ID_REQ']."'";
 //                $swhere4 = "where E.NO_REQ_DEV = '".$data['ID_REQ']."'";
 //                $swhere5 = "where B.NO_REQ_REL = '".$data['ID_REQ']."'";
 //        }
 //        $this->db1 = $this->load->database('itos',true);
 //        // $searchArr[] = 'SELECT A.NO_CONTAINER,(SELECT REGEXP_SUBSTR ((SELECT JNS_CONT A FROM BH_DETAIL_REQUEST A '.$where1.'), '[^-]+', 1, 1)SZ
 //        //     FROM dual),(SELECT REGEXP_SUBSTR ((SELECT JNS_CONT A FROM BH_DETAIL_REQUEST A '.$where1.'), '[^-]+', 1, 2)TY
 //        //     FROM dual),(SELECT REGEXP_SUBSTR ((SELECT JNS_CONT A FROM BH_DETAIL_REQUEST A '.$where1.'), '[^-]+', 1, 3)ST
 //        //     FROM dual),HAZZARD AS HZ from BH_DETAIL_REQUEST A '.$swhere1;  // WHERE ID_NOTA='$p1' group by NO_CONTAINER';
 //        $searchArr[] = "SELECT A.NO_CONTAINER,
 //            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 1)) SZ FROM dual) SZ,
 //            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 2)) TY FROM dual) TY,
 //            (SELECT TO_CHAR(REGEXP_SUBSTR ((SELECT A.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere1."), '[^-]+', 1, 3)) ST FROM dual) ST,
 //            A.HAZZARD AS HZ from BH_DETAIL_REQUEST A ".$swhere1;

        
 //        $searchArr[] = "SELECT C.NO_CONTAINER,TO_CHAR(C.SIZE_CONT) AS SZ,C.TYPE_CONT AS TY,C.STATUS_CONT AS ST,C.HZ
 //                         from REQ_RECEIVING_D C ".$swhere2;  // where trim(NO_REQ_ANNE)='".$data[KD_PERMINTAAN]."'';
 //        $searchArr[] = "SELECT D.NO_CONTAINER,(SELECT REGEXP_SUBSTR ((SELECT D.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere3."), '[^-]+', 1, 1)SZ FROM dual) SZ,(SELECT REGEXP_SUBSTR ((SELECT D.JNS_CONT FROM BH_DETAIL_REQUEST A ".$swhere3."), '[^-]+', 1, 2)TY FROM dual) TY,D.STATUS AS ST,D.HZ
 //                         from TB_BATALMUAT_D D  ".$swhere3;  // where trim(ID_BATALMUAT)='".$data[KD_PERMINTAAN]."'';

 //        $searchArr[] = "SELECT E.NO_CONTAINER,TO_CHAR(E.SIZE_CONT) AS SZ,E.TYPE_CONT AS TY,E.STATUS_CONT AS ST,E.HZ
 //                         from REQ_DELIVERY_D E ".$swhere4;  // where trim(NO_REQ_DEV)='".$data[KD_PERMINTAAN]."'';
 //        // $searchArr[] = 'SELECT A.NO_CONTAINER,B.KODE_BARANG,B.UKURAN,B.TYPE,B.STATUS,B.HEIGHT_CONT
 //                         //from EXMO_DETAIL_REQUEST A INNER JOIN MASTER_BARANG B ON A.ID_BARANG =B.KODE_BARANG '.$swhere1; //where trim(ID_REQUEST)='".$data[KD_PERMINTAAN]."'';

        

 //        $searchArr[] = "SELECT B.NO_CONTAINER,TO_CHAR(B.SIZE_CONT) SZ,B.TYPE_CONT TY,B.STATUS_CONT ST,B.HZ
 //                         from REQ_RELOAD_D B ".$swhere5;  // where trim(NO_REQ_REL)='".$data[KD_PERMINTAAN]."'';

        
 //        $select = implode(" union ", $searchArr);
 //        // die($select);
 //        $query = $this->db1->query("select * from (".$select.")");
 //        $result = $query->result();
 //        return $result;
 //    }
     public function UpdateNotaSource($data1)
     {        
        $jenis_nota= $data1['LAYANAN'];
        $status= $data1['STATUS'];
        $idnota= $data1['ID_NOTA'];
        $data= array('ID_NOTA'=>$idnota,'STATUS'=>$status);
        $id= array('ID_NOTA'=>$idnota);
        $result = '';
        $this->db1 = $this->load->database('itos',true);

        // print_r($data1);die;
        if ($jenis_nota=='RECEIVING'){
            $this->load->model('receiving_model');
            $result = $this->receiving_model->update($data,$id);            
        } elseif($jenis_nota=='DELIVERY'){
            $this->load->model('delivery_model');
            $result = $this->delivery_model->update($data,$id);
        } elseif($jenis_nota=='BATAL MUAT'){
            $this->load->model('batalmuat_model');
            $data= array('NO_NOTA'=>$idnota,'STATUS'=>$status);
            $id= array('NO_NOTA'=>$idnota);
            $result = $this->batalmuat_model->update($data,$id);
        } elseif($jenis_nota=='BEHANDLE'){
            $this->load->model('bh_model');
            $result = $this->bh_model->update($data,$id);
        } elseif($jenis_nota=='EXMO'){ 
            $this->load->model('exmo_model');
            $result = $this->exmo_model->update($data,$id);
        } elseif($jenis_nota=='TRANSHIPMENT'){
            $this->load->model('transhipment_model');
            $result = $this->transhipment_model->update($data,$id);
        } elseif($jenis_nota=='REEXPORT'){
            $this->load->model('reexport_model');
            $result = $this->reexport_model->update($data,$id);
        } elseif($jenis_nota=='STACKEXT'){
            $this->load->model('stackext_model');
            $result = $this->stackext_model->update($data,$id);
        } elseif($jenis_nota=='RNM'){
            $this->load->model('rename_model');
            $result = $this->rename_model->update($data,$id);
        } elseif($jenis_nota=='HICO'){
            $this->load->model('hicoscan_model');
            $result = $this->hicoscan_model->update($data,$id);
        }

        // $this->db1 = $this->load->database('itos',true);
        // $query = $this->db1->query($select);
        // // $result = $query->result();
        // $result = $query->row_array();
        return $result;
     } 
        
     
    public function getQueryItos($select){
        // $his->load->database();
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->result();
        return $result;
    }
    
    
    public function getUper($data = null, $row= null){
        
        $where = array();
        if(isset($data['NO_UPER'])){
            if(!empty($data['NO_UPER'])){
                $where['NO_UPER']=$data['NO_UPER'];
            }
        }

        if(isset($data['STATUS_LUNAS'])){
            if(!empty($data['STATUS_LUNAS'])){
                $where['LUNAS']=$data['STATUS_LUNAS'];
            }
        }

        // if($data['STATUS']!=''){
        //     $where['LUNAS']=$data['STATUS'];
        // }
        // if($data['INV_BANK_NAME']!=''){
        //     $where['INV_BANK_NAME']=$data['INV_BANK_NAME'];
        // }
        // die('123');

        $this->db1 = $this->load->database('itos',true);
        $select = 'NO_UPER, NO_UKK,NM_PERUSAHAAN AS EMKL,CUSTOMER_NUMBER,ORG_ID,LUNAS AS STATUS,ALAMAT, VESSEL,VOYAGE VOYAGE_IN, 
                    VOYAGE_OUT,TGL_ENTRY as TGL_SIMPAN,TGL_LUNAS, PAYMENT_VIA,TOTAL,\'\' AS COA,JENIS_UPER AS KD_MODUL,
                    \'UPER\' LAYANAN, \'ANNE\' KET_JENIS, PPN, STATUS_AR , STATUS_ARMSG , NPWP,\'\' as MATERAI, VALUTA AS VAL,\'PETIKEMAS\' MODUL';
        
        // die($select);
        $this->db1->select($select)
            ->from('UPER_H')
            ->like($where)
            ->order_by('TGL_SIMPAN','desc');

        $query = $this->db1->get();
        if($row==null){
            $result = $query->result_array();
        } else {
            $result = $query->row_array();
        }
        return $result;
    }
    public function getUperD($jenis_nota, $swhere){
        $this->load->model('other_model');
        
        $swhere1 = ' where NO_UPER ='.'\''.$swhere.'\'';

        $select = 'select *  from UPER_D ' .$swhere1;

        
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->result_array();
        // $result = $query->row_array();
        return $result;
     } 
     // data 
    public function uperpay_new($data){   
            // print_r($data);die;
            $result = '';
            $this->load->model('other_model');
            $this->load->model('invlines_model');
            $no_uper = $data['NO_UPER'];
            $method = $data['RECEIPT_METHOD'];
            $bank = $data['BANK_ID'];
            $databank = $this->getBankID($bank);
            $bank_account = $databank['BANK_ACCOUNT_NAME'];
            $bank_id       = $databank['BANK_ID'];
            $bank_receiptmethod  = $databank['RECEIPT_METHOD'];
            $user_lunas = $data['USER_LUNAS'];
            // $bank = $data['RECEIPT_ACCOUNT'];
            $layanan = $data['LAYANAN'];
            $total = $data['TOTAL'];
            $where = array('NO_UPER'=>$no_uper);
            $data1 = $this->getUper($where,'ROW');
            // print_r($data1);die;
            $data1['ID_NOTA']= $no_uper;
            $data1['ID_REQ']= $no_uper;
            $data1['RECEIPT_METHOD'] = $bank_receiptmethod;
            $data1['BANK_ID'] = $bank;
            $data1['LAYANAN'] = $layanan;
            $data1['TOTAL'] = $total;
            $data1['STATUS'] = 'P'; 
            $data1['NO_FAKTUR'] = ''; 
            $data1['TGL_PAYMENT'] = date("d-M-Y");
            $tglDetail = $this->get_date();
            // $tglDetail = CURRENT_TIMESTAMP ; //date("d-M-Y H:i:s");
            // print_r($bank_receiptmethod);die(); 
            // print_r($data2);die();
            $dataUper = $this->getdataUper($no_uper);
            $dataUper['LAYANAN'] = $layanan;
            $data2 = $this->InsertReceipH($dataUper);
            $this->load->model('receipts_model');
            $result = $this->receipts_model->insert($data2);
            if($result){
                $tglsimpan =  date("d-M-Y");
                // $this->db->insert_batch('XEINVC_AR_INVOICE_LINES',$dataline);
                $update = array(
                    'NO_UPER'=>$no_uper,
                    'LUNAS'=>'P',
                    // 'JUMLAH'=>$total,
                    // 'TOTAL'=>$total,
                    // 'PPN'=>'0',
                    // 'TGL_LUNAS'=>sysdate,
                    'USER_LUNAS'=>$user_lunas,
                    'PAYMENT_VIA'=> $bank_account,
                    'BANK_ID'=>$bank,
                    'RECEIPT_METHOD'=>$bank_receiptmethod,
                    // 'TGL_LUNAS'=>sysdate,
                    'TGL_LUNAS2'=>$tglDetail
                );
                // print_r($update);die();
                $result = $this->UpperUpdateH($update); 
            }
           
        return $result;
            // print_r($result);die;
    }

    public function uperpay($data){   
            // print_r($data);die;
            $result = '';
            $this->load->model('other_model');
            $this->load->model('invlines_model');
            $no_uper = $data['NO_UPER'];
            $method = $data['RECEIPT_METHOD'];
            $bank = $data['BANK_ID'];
            $databank = $this->getBankID($bank);
            $bank_account = $databank['BANK_ACCOUNT_NAME'];
            $bank_id       = $databank['BANK_ID'];
            $bank_receiptmethod  = $databank['RECEIPT_METHOD'];
            $user_lunas = $data['USER_LUNAS'];
            // $bank = $data['RECEIPT_ACCOUNT'];
            $layanan = $data['LAYANAN'];
            $total = $data['TOTAL'];
            $where = array('NO_UPER'=>$no_uper);
            $data1 = $this->getUper($where,'ROW');
            // print_r($data1);die;
            $data1['ID_NOTA']= $no_uper;
            $data1['ID_REQ']= $no_uper;
            $data1['RECEIPT_METHOD'] = $bank_receiptmethod;
            $data1['BANK_ID'] = $bank;
            $data1['LAYANAN'] = $layanan;
            $data1['TOTAL'] = $total;
            $data1['STATUS'] = 'P'; 
            $data1['NO_FAKTUR'] = ''; 
            $data1['TGL_PAYMENT'] = date("d-M-Y");
            $tglDetail = $this->get_date();
            // $tglDetail = CURRENT_TIMESTAMP ; //date("d-M-Y H:i:s");
            // print_r($bank_receiptmethod);die(); 
           
            // print_r($data2);die();
            
                   
            $tglsimpan =  date("d-M-Y");
            // $this->db->insert_batch('XEINVC_AR_INVOICE_LINES',$dataline);
                $update = array(
                    'NO_UPER'=>$no_uper,
                    'LUNAS'=>'P',
                    // 'JUMLAH'=>$total,
                    // 'TOTAL'=>$total,
                    // 'PPN'=>'0',
                    // 'TGL_LUNAS'=>sysdate,
                    'USER_LUNAS'=>$user_lunas,
                    'PAYMENT_VIA'=> $bank_account,
                    'BANK_ID'=>$bank,
                    'RECEIPT_METHOD'=>$bank_receiptmethod,
                    // 'TGL_LUNAS'=>sysdate,
                    'TGL_LUNAS2'=>$tglDetail
            );
            $result = $this->UpperUpdateH($update); 
                if ($result){
                    $dataUper = $this->getdataUper($no_uper);
                    $dataUper['LAYANAN'] = $layanan;
                    $data2 = $this->InsertReceipH($dataUper);
                    $this->load->model('receipts_model');
                    $result2 = $this->receipts_model->insert($data2);
                    if ($result2 != 1){
                        $result = $this->UpperUpdateRb($update); 
                    }
                }
            // }
            // }
        // return 1;
            // print_r($result);die();
        return $result;
    }
    public function InsertReceipH($data){
        $orgid = $this->getOrgID();
        $termid = $this->getTerminal();
        $Kplvoyage = $data['VESSEL']." / ".$data['VOYAGE']." - ". $data['VOYAGE_OUT'];
        $periode =$periode = $data['ETA']." s/d ". $data['ETD'];;
        
        
        // $selectRepo ="SELECT to_date(ETA,'YYYYMMDDHH24MISS') as ETA,to_date(ETD,'YYYYMMDDHH24MISS') as ETD FROM M_VSB_VOYAGE WHERE VESSEL ='$data[VESSEL]' and VOYAGE_IN ='$data[VOYAGE]' and VOYAGE_OUT='$data[VOYAGE_OUT]'";
                  
        // $this->db2 = $this->load->database('itos_repo',true);
        // $query2 = $this->db2->query($selectRepo);
        // $dataETA = $query2->row_array();
        // print_r($periode);die();
        // if(!empty($dataETA['ETA'] && $dataETA['ETD'])){}
        //     $periode = $dataETA['ETA']." -s/d- ". $dataETA['ETD'];
        // }

         if (!empty($data['BANK_ID'])){
            $bankData = $this->getBankID($data['BANK_ID']);
            // print_r($bankData);
            // [BANK_ACCOUNT_NAME] 
            $receipt_account= $bankData['RECEIPT_METHOD'] ;
            $bank_account = $bankData['BANK_ACCOUNT_NAME'];

         }
        


        $InsertData = array(
             'ORG_ID' =>'1827', //$orgid, //belum fix
             'RECEIPT_NUMBER' => $data['NO_UPER'],
             'RECEIPT_METHOD' => $receipt_account, 
             'RECEIPT_ACCOUNT' => $bank_account,
             'BANK_ID' => $data['BANK_ID'],//$data->BANK_ID,
             'CUSTOMER_NUMBER' => $data['CUSTOMER_NUMBER'],  
             'RECEIPT_DATE' =>$data['TGL_LUNAS'],
             'CURRENCY_CODE' => $data['VALUTA'],
             'STATUS' => $data['LUNAS'], 
             'AMOUNT' => $data['TOTAL'],
             'PROCESS_FLAG' => '',
             'ERROR_MESSAGE' => '',  
             'API_MESSAGE' => '',  
             'ATTRIBUTE_CATEGORY' =>'UPER', //$data['KD_MODUL'],$$ COnfirm Data 
             'REFERENCE_NUM' => '',
             'RECEIPT_TYPE' =>  $data['LAYANAN'],
             'RECEIPT_SUB_TYPE' =>'',  
             'CREATED_BY' => '',  
             // 'CREATION_DATE' => $data['TGL_SIMPAN'],  
             'TERMINAL' => $termid,  
             'ATTRIBUTE1' => $data['NO_UPER'],
             'ATTRIBUTE2' => '',
             'ATTRIBUTE3' => '',
             'ATTRIBUTE4' => '',
             'ATTRIBUTE5' => '',
             'ATTRIBUTE6' => $data['TGL_LUNAS'],
             'ATTRIBUTE7' => '',
             'ATTRIBUTE8' => $Kplvoyage,
             'ATTRIBUTE9' => $periode,
             'ATTRIBUTE10' => '',  
             'ATTRIBUTE11' => $data['TOTAL'],  
             'ATTRIBUTE12' => '',  
             'ATTRIBUTE13' => '',  
             'ATTRIBUTE14' => 'PTKM02', //COnfirm Field
             'ATTRIBUTE15' => '',  
             // 'STATUS_RECEIPT' => 'N',//$data['STATUS_AR'],
             'SOURCE_INVOICE' => 'ITOSJBI_NBM',
             'SOURCE_INVOICE_TYPE' => 'ITOS', 
             'STATUS_RECEIPTMSG' => 'Generate Uper Invoice Susses',
             'BRANCH_CODE'=>'JBI',
             'BRANCH_ACCOUNT'=>'100',
             'SOURCE_SYSTEM'=>'EINVOICE'
         );
         // print_r($InsertData);die;
         return $InsertData;
     
     }
     public function uperupdate($data){   
            // print_r($data);die;
            $result = '';
            $this->load->model('other_model');
            $this->load->model('invlines_model');
            $no_uper = $data['NO_UPER'];
            $method = $data['RECEIPT_METHOD'];
            $bank = $data['BANK_ID'];
            $databank = $this->getBankID($bank);
            $bank_account = $databank['BANK_ACCOUNT_NAME'];
            $bank_id       = $databank['BANK_ID'];
            $bank_receiptmethod  = $databank['RECEIPT_METHOD'];
            $user_lunas = $data['USER_LUNAS'];
            // $bank = $data['RECEIPT_ACCOUNT'];
            $layanan = $data['LAYANAN'];
            $total = $data['TOTAL'];
            $where = array('NO_UPER'=>$no_uper);
            $data1 = $this->getUper($where,'ROW');
            // print_r($data1);die;
            $data1['ID_NOTA']= $no_uper;
            $data1['ID_REQ']= $no_uper;
            $data1['RECEIPT_METHOD'] = $bank_receiptmethod;
            $data1['BANK_ID'] = $bank;
            $data1['LAYANAN'] = $layanan;
            $data1['TOTAL'] = $total;
            $data1['STATUS'] = 'P'; 
            $data1['NO_FAKTUR'] = ''; 
            $data1['TGL_PAYMENT'] = date("d-M-Y");
            $tglsimpan =  date("d-M-Y");
            $tglDetail =  $this->get_date();
                   
            $update = array(
                'NO_UPER'=>$no_uper,
                'LUNAS'=>'P',
                // 'JUMLAH'=>$total,
                // 'TOTAL'=>$total,
                // 'PPN'=>'0',
                // 'TGL_LUNAS'=>sysdate,
                'USER_LUNAS'=>$user_lunas,
                'PAYMENT_VIA'=> $bank_account,
                'BANK_ID'=>$bank,
                'RECEIPT_METHOD'=>$bank_receiptmethod,
                // 'TGL_LUNAS'=>sysdate,
                'TGL_LUNAS2'=>$tglDetail
            );
            $result = $this->UpperUpdateH($update);     
            // }
            // }
        return $result;
            // print_r($result);die;
    }
    public function UpperUpdateH($update){
        $no_uper = $update['NO_UPER'];
        $sqlTgl2 = "UPDATE UPER_H SET TGL_LUNAS=sysdate,USER_LUNAS='".$update['USER_LUNAS']."',
                TGL_LUNAS2='".$update['TGL_LUNAS2']."',
                LUNAS ='P',
                STATUS_AR ='S',
                STATUS_ARMSG ='Generate Success Via Einvoice (Receipt: $no_uper)',
                PAYMENT_VIA='".$update['PAYMENT_VIA']."',
                BANK_ID='".$update['BANK_ID']."',
                RECEIPT_METHOD='".$update['RECEIPT_METHOD']."'
                 WHERE NO_UPER='".$no_uper."'";        
        // $select='select * from MST_BANK_SIMKEU where BANK_ID =\''.$bank.'\'';
        $this->db1 = $this->load->database('itos',true);
        // echo $sqlTgl2;die();
        $query = $this->db1->query($sqlTgl2);
        return 1;
     }
      public function UpperUpdateRb($update){
        $no_uper = $update['NO_UPER'];
        $sqlUpd = "UPDATE UPER_H SET USER_LUNAS='".$update['USER_LUNAS']."',
                LUNAS ='N',
                STATUS_AR ='F',
                STATUS_ARMSG ='Generate Failed (Receipt: $no_uper)'
                 WHERE NO_UPER='".$no_uper."'";
        // $select='select * from MST_BANK_SIMKEU where BANK_ID =\''.$bank.'\'';
        $this->db1 = $this->load->database('itos',true);
        // echo $sqlTgl2;die();
        $query = $this->db1->query($sqlUpd);
        return 1;
     } 
      public function getdataUper($data = null){
        // $this->load->model('other_model');
         // print_r($bank."-");die();
        //$select='select * from UPER_H where no_uper =\''.$data.'\'';
        $select ="SELECT UH.*, to_date(MVV.ETA,'YYYYMMDDHH24MISS') as ETA,  to_date(MVV.ETD,'YYYYMMDDHH24MISS') as ETD
                  FROM UPER_H UH
                  LEFT JOIN ITOS_REPO.M_VSB_VOYAGE MVV ON UH.VESSEL = MVV.VESSEL AND UH.VOYAGE = MVV.VOYAGE_IN AND UH.VOYAGE_OUT = MVV.VOYAGE_OUT
                  WHERE UH.NO_UPER = '$data'";
        $this->db1 = $this->load->database('itos',true);
        $query = $this->db1->query($select);
        $result = $query->row_array();

        // // print_r($result['VESSEL']."--".$result['VOYAGE']."--".$result['VOYAGE_OUT']."8888");die();
        // $selectRepo ="SELECT to_date(ETA,'YYYYMMDDHH24MISS') as ETA,  to_date(ETD,'YYYYMMDDHH24MISS') as ETD FROM M_VSB_VOYAGE WHERE VESSEL ='$result[VESSEL]' and VOYAGE_IN ='$result[VOYAGE]' and VOYAGE_OUT='$result[VOYAGE_OUT]'";
        //           // LEFT JOIN ITOS_REPO.M_VSB_VOYAGE MVV ON UH.VESSEL = MVV.VESSEL AND UH.VOYAGE = MVV.VOYAGE_IN AND UH.VOYAGE_OUT = MVV.VOYAGE_OUT
        //           // WHERE UH.NO_UPER='$no_uper' "';
        // $this->db2 = $this->load->database('itos_repo',true);
        // $query2 = $this->db2->query($selectRepo);
        // $result2 = $query2->row_array();
        // if(count($result) > 0) {
        //   if($result2) {
        //     $result['ETA'] = $result2['ETA'];
        //     $result['ETD'] = $result2['ETD'];
        //   }
        //   $result = $result2;
        // }
        return $result;
     }
     public function getdataUperETA($data = null){
       
        // print_r($result['VESSEL']."--".$result['VOYAGE']."--".$result['VOYAGE_OUT']."8888");die();
        $selectRepo ="SELECT to_date(ETA,'YYYYMMDDHH24MISS') as ETA,  to_date(ETD,'YYYYMMDDHH24MISS') as ETD FROM M_VSB_VOYAGE WHERE VESSEL ='$result[VESSEL]' and VOYAGE_IN ='$result[VOYAGE]' and VOYAGE_OUT='$result[VOYAGE_OUT]'";
                  // LEFT JOIN ITOS_REPO.M_VSB_VOYAGE MVV ON UH.VESSEL = MVV.VESSEL AND UH.VOYAGE = MVV.VOYAGE_IN AND UH.VOYAGE_OUT = MVV.VOYAGE_OUT
                  // WHERE UH.NO_UPER='$no_uper' "';
        $this->db2 = $this->load->database('itos_repo',true);
        $query2 = $this->db2->query($selectRepo);
        $result = $query2->row_array();
        // if(count($result) > 0) {
        //   if($result2) {
        //     $result['ETA'] = $result2['ETA'];
        //     $result['ETD'] = $result2['ETD'];
        //   }
        //   $result = $result2;
        // }
        return $result;
     }
     public function get_date(){
        $query = $this->db1->query("select CURRENT_TIMESTAMP from DUAL");
        // $query = $this->db1->get();
        $result = $query->result_array();
        return $result[0]['CURRENT_TIMESTAMP'];

     }
     public function getAll($a,$b){
        // echo "===>|".$a."|".$b;die();
        $where = array();
        if($a!=''){
            $where['XEINVC_AR_RECEIPTS_HEADER.RECEIPT_NUMBER']=$a;
        }
        // if($b!=''){
        //     if($b == 'KAPAL'){
        //         $where['XEINVC_AR_RECEIPTS_HEADER.HEADER_CONTEXT']='KPL';
        //     } elseif ($b =='RUPARUPA') {
        //         $where['XEINVC_AR_RECEIPTS_HEADER.HEADER_CONTEXT']='RUPA';
        //     } elseif ($b =='BARANG') {
        //         $where['XEINVC_AR_RECEIPTS_HEADER.HEADER_CONTEXT']='BRG';
        //     } else {
        //         $where['XEINVC_AR_RECEIPTS_HEADER.HEADER_CONTEXT']='PTKM';
        //     }
        // }else {
        //     $where['XEINVC_AR_RECEIPTS_HEADER.HEADER_CONTEXT']='PTKM';
        // }
        // print_r($where);die();exit();
        $this->db->select('*')
            ->from('XEINVC_AR_RECEIPTS_HEADER')
            ->join('INV_MST_UNIT', "XEINVC_AR_RECEIPTS_HEADER.ORG_ID = COALESCE(TO_NUMBER(REGEXP_SUBSTR(INV_MST_UNIT.INV_UNIT_ORGID, '^\d+(\.\d+)?')), 0)","LEFT")
            ->join('INV_MST_ENTITY', 'INV_MST_ENTITY.INV_ENTITY_CODE = INV_MST_UNIT.INV_ENTITY_CODE',"LEFT")
            ->join('INV_MST_PEJABAT', 'INV_MST_PEJABAT.INV_UNIT_ID = INV_MST_UNIT.INV_UNIT_ID',"LEFT")
            ->join('INV_MST_FAKTUR', 'INV_MST_ENTITY.INV_ENTITY_ID =  INV_MST_FAKTUR.INV_ENTITY_ID',"LEFT")
            ->like($where);
            $this->db->order_by('XEINVC_AR_RECEIPTS_HEADER.RECEIPT_DATE','desc');
            
        // print_r($this->db->select());die();exit();
        $query = $this->db->get();
        $result = $query->result_array();
        // print_r($result);die();
        $this->db->select('*');
        $this->db->from('XEINVC_AR_RECEIPTS_HEADER');
        $this->db->join('INV_MST_UNIT', "XEINVC_AR_RECEIPTS_HEADER.ORG_ID = COALESCE(TO_NUMBER(REGEXP_SUBSTR(INV_MST_UNIT.INV_UNIT_ORGID, '^\d+(\.\d+)?')), 0)","LEFT");
        $this->db->join('INV_MST_ENTITY', 'INV_MST_ENTITY.INV_ENTITY_CODE = INV_MST_UNIT.INV_ENTITY_CODE',"LEFT");
        $this->db->join('INV_MST_PEJABAT', 'INV_MST_PEJABAT.INV_UNIT_ID = INV_MST_UNIT.INV_UNIT_ID',"LEFT");
        $this->db->join('INV_MST_FAKTUR', 'INV_MST_ENTITY.INV_ENTITY_ID =  INV_MST_FAKTUR.INV_ENTITY_ID',"LEFT");
        $this->db->like($where);
        $this->db->where("TO_DATE (SYSDATE, 'dd-mm-yyyy') BETWEEN TO_DATE ((INV_MST_PEJABAT.INV_PEJABAT_EFECTIVE), 'dd-mm-yyyy') AND TO_DATE (INV_MST_PEJABAT.INV_PEJABAT_EXPIRED, 'dd-mm-yyyy') ");
        $this->db->where('INV_MST_PEJABAT.INV_PEJABAT_STATUS','Ya');
        $this->db->order_by('XEINVC_AR_RECEIPTS_HEADER.RECEIPT_DATE','desc');
        $query2 = $this->db->get();
        $result2 = $query2->result_array();

        if(count($result) > 0) {
          if($result2) {
            $result[0]['INV_PEJABAT_JABATAN'] = $result2[0]['INV_PEJABAT_JABATAN'];
            $result[0]['INV_PEJABAT_NIPP'] = $result2[0]['INV_PEJABAT_NIPP'];
            $result[0]['INV_PEJABAT_TTD'] = $result2[0]['INV_PEJABAT_TTD'];
            $result[0]['INV_PEJABAT_NAME'] = $result2[0]['INV_PEJABAT_NAME'];
          }
          $result = $result[0];
        }
        // print_r($result);
        // $result['emkl'] = $result['CUSTOMER_NUMBER'];
        $result['EMKL'] = $this->getCustName($result['CUSTOMER_NUMBER']);
        // print_r($result);die();
        return $result;
    }
    
}