<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/../classes/PHPExcel.php';
ini_set('MAX_EXECUTION_TIME', -1);

class Cli extends CI_Controller
{
    static $conn = null;
    static $startTime = null;
    static $endTime = null;
    static $userid = null;
    static $filename = null;
    static $rec_id = null;

    public function __construct()
    {
        
        parent::__construct();
        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    }

    public static function connectServer($id){
        // phpinfo();
        // exit();
        if($id==43){
            Cli::$conn = oci_connect(ORACLE_USERNAME_43,ORACLE_PASSWORD_43, ORACLE_HOST_43);
        }elseif($id==55){
            Cli::$conn = oci_connect(ORACLE_USERNAME_55,ORACLE_PASSWORD_55, ORACLE_HOST_55);
        }elseif($id==208){
            Cli::$conn = oci_connect(ORACLE_USERNAME_208,ORACLE_PASSWORD_208, ORACLE_HOST_208);
        }elseif($id==236){
            Cli::$conn = oci_connect(ORACLE_USERNAME_236,ORACLE_PASSWORD_236, ORACLE_HOST_236);
        }elseif($id==234){
            Cli::$conn = oci_connect(ORACLE_USERNAME_234,ORACLE_PASSWORD_234, ORACLE_HOST_234);
        }elseif($id==203){
            Cli::$conn = oci_connect(ORACLE_USERNAME_203,ORACLE_PASSWORD_203, ORACLE_HOST_203);
        }elseif($id==70){
            Cli::$conn = oci_connect(ORACLE_USERNAME_70,ORACLE_PASSWORD_70, ORACLE_HOST_70);
        }
    }


    public static function doGenerateReport($job)
    {   
        Cli::$startTime = microtime();
        $data = unserialize($job->workload());
        Cli::$userid = $data['userid'];
        Cli::$filename = $data['filename'];
        Cli::$rec_id = $data['rec_id'];

        if(isset($data['importChk']) && $data['importChk']!=null){
            if(isset($data['exportChk']) && $data['exportChk']!=null){
                if(isset($data['grnChk']) && $data['grnChk']!=null){
                    Cli::connectServer(208);
                    $stid_208_import = Cli::processQueryAsyPlusImport($data);
                    $stid_208_export = Cli::processQueryAsyPlusExport($data);
                    $stid_208_grn = Cli::processQueryAsyPlusGrn($data);
                    Cli::connectServer(43);
                    $stid_43_import = Cli::processQueryWorldImport($data);
                    $stid_43_export = Cli::processQueryWorldExport($data);
                    $stid_43_grn = Cli::processQueryWorldGrn($data);
                    Cli::connectServer(55);
                    $stid_55_import = Cli::processQueryWorldImport($data);
                    $stid_55_export = Cli::processQueryWorldExport($data);
                    $stid_55_grn = Cli::processQueryWorldGrn($data);

                    return Cli::generateExcel(array($stid_208_import,$stid_43_import,$stid_55_import),array($stid_208_export,$stid_43_export,$stid_55_export),array($stid_208_grn,$stid_43_grn,$stid_55_grn));
                }else{
                    Cli::connectServer(208);
                    $stid_208_import = Cli::processQueryAsyPlusImport($data);
                    $stid_208_export = Cli::processQueryAsyPlusExport($data);
                    Cli::connectServer(43);
                    $stid_43_import = Cli::processQueryWorldImport($data);
                    $stid_43_export = Cli::processQueryWorldExport($data);
                    Cli::connectServer(55);
                    $stid_55_import = Cli::processQueryWorldImport($data);
                    $stid_55_export = Cli::processQueryWorldExport($data);

                    return Cli::generateExcel(array($stid_208_import,$stid_43_import,$stid_55_import),array($stid_208_export,$stid_43_export,$stid_55_export),null);
                }
            }else{
                if(isset($data['grnChk']) && $data['grnChk']!=null){
                    Cli::connectServer(208);
                    $stid_208_import = Cli::processQueryAsyPlusImport($data);
                    $stid_208_grn = Cli::processQueryAsyPlusGrn($data);
                    Cli::connectServer(43);
                    $stid_43_import = Cli::processQueryWorldImport($data);
                    $stid_43_grn = Cli::processQueryWorldGrn($data);
                    Cli::connectServer(55);
                    $stid_55_import = Cli::processQueryWorldImport($data);
                    $stid_55_grn = Cli::processQueryWorldGrn($data);

                    return Cli::generateExcel(array($stid_208_import,$stid_43_import,$stid_55_import),null,array($stid_208_grn,$stid_43_grn,$stid_55_grn));
                }else{
                    Cli::connectServer(208);
                    $stid_208_import = Cli::processQueryAsyPlusImport($data);
                    Cli::connectServer(43);
                    $stid_43_import = Cli::processQueryWorldImport($data);
                    Cli::connectServer(55);
                    $stid_55_import = Cli::processQueryWorldImport($data);

                    return Cli::generateExcel(array($stid_208_import,$stid_43_import,$stid_55_import),null,null);
                }
            }
            
        }else{
            if(isset($data['exportChk']) && $data['exportChk']!=null){
                if(isset($data['grnChk']) && $data['grnChk']!=null){
                    Cli::connectServer(208);
                    $stid_208_export = Cli::processQueryAsyPlusExport($data);
                    $stid_208_grn = Cli::processQueryAsyPlusGrn($data);
                    Cli::connectServer(43);
                    $stid_43_export = Cli::processQueryWorldExport($data);
                    $stid_43_grn = Cli::processQueryWorldGrn($data);
                    Cli::connectServer(55);
                    $stid_55_export = Cli::processQueryWorldExport($data);
                    $stid_55_grn = Cli::processQueryWorldGrn($data);

                    return Cli::generateExcel(null,array($stid_208_export,$stid_43_export,$stid_55_export),array($stid_208_grn,$stid_43_grn,$stid_55_grn));
                }else{
                    Cli::connectServer(208);
                    $stid_208_export = Cli::processQueryAsyPlusExport($data);
                    Cli::connectServer(43);
                    $stid_43_export = Cli::processQueryWorldExport($data);
                    Cli::connectServer(55);
                    $stid_55_export = Cli::processQueryWorldExport($data);

                    return Cli::generateExcel(null,array($stid_208_export,$stid_43_export,$stid_55_export),null);
                }
            }else{
                if(isset($data['grnChk']) && $data['grnChk']!=null){
                    Cli::connectServer(208);
                    $stid_208_grn = Cli::processQueryAsyPlusGrn($data);
                    Cli::connectServer(43);
                    $stid_43_grn = Cli::processQueryWorldGrn($data);
                    Cli::connectServer(55);
                    $stid_55_grn = Cli::processQueryWorldGrn($data);

                    return Cli::generateExcel(null,null,array($stid_208_grn,$stid_43_grn,$stid_55_grn));
                }else{
                    
                }
            }
        }

    }



    public static function processQueryWorldImport($data){
        if (!Cli::$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $sql = "select DEC_COD,
                CMP_CON_COD,
                DEC_REF_YER,  
                IDE_CUO_COD,
                IDE_REG_SER,
                IDE_REG_NBR,
                IDE_REG_DAT,
                IDE_AST_DAT,
                IDE_RCP_DAT,  
                IDE_TYP_SAD,  
                GEN_CTY_EPT_NAM,
                GDS_ORG_CTY,
                i.KEY_ITM_NBR,
                TAR_HSC_NB1,  
                 TAR_PRC_EXT,
                 TAR_PRC_NAT,
                 TAR_SUP_QTY,  
                 VIT_WGT_GRS,
                 VIT_WGT_NET,    
                 TAR_SUP_COD,    
                  VIT_STV,
                             SUM(CASE  WHEN t.TAX_LIN_COD ='CID'  and tax_lin_mop = '1' THEN     t.TAX_LIN_AMT ELSE 0 END) CID,  
                            SUM(CASE  WHEN t.TAX_LIN_COD = 'EIC'   and tax_lin_mop = '1' THEN    t.TAX_LIN_AMT ELSE 0 END) EIC,                     
                            SUM(CASE  WHEN t.TAX_LIN_COD ='PAL'  and tax_lin_mop = '1' THEN       t.TAX_LIN_AMT ELSE 0 END)PAL,                    
                            SUM(CASE  WHEN t.TAX_LIN_COD ='RDL'   and tax_lin_mop = '1' THEN      t.TAX_LIN_AMT ELSE 0 END) RDL,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='SCL'   and tax_lin_mop = '1' THEN       t.TAX_LIN_AMT ELSE 0 END)  SCL,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='SRL'  and tax_lin_mop = '1' THEN          t.TAX_LIN_AMT ELSE 0 END) SRL,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='SUR'   and tax_lin_mop = '1' THEN          t.TAX_LIN_AMT ELSE 0 END)  SUR,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='VAT'    and tax_lin_mop = '1' THEN        t.TAX_LIN_AMT ELSE 0 END)  VAT,
                            SUM(CASE  WHEN  t.TAX_LIN_COD ='NBT'  and tax_lin_mop = '1' THEN           t.TAX_LIN_AMT ELSE 0 END)  NBT,                    
                            SUM(CASE  WHEN  t.TAX_LIN_COD ='XID'   and tax_lin_mop = '1' THEN           t.TAX_LIN_AMT ELSE 0 END)  XID  from
                 awunadm.sad_general_Segment g, awunadm.sad_item i
                 LEFT OUTER JOIN   awunadm.SAD_Tax t ON i.instanceid=t.instanceid  and  i.KEY_ITM_NBR = t.KEY_ITM_NBR  
                 LEFT OUTER JOIN   awunadm.sad_supplementary_unit s ON  i.instanceid=s.instanceid and i.key_itm_nbr=s.key_itm_nbr and key_sup_rnk=1
                 LEFT OUTER JOIN   awunadm.UNTARTAB h ON h.hs6_cod || h.tar_pr1 = i.TAR_HSC_NB1
                where
                not EXISTS
                (SELECT *
                from  awunadm.UN_ASYBRK_TRACK k,   awunadm.UN_ASYBRK_IED e
                WHERE
                 e.ied_id=k.ied_id  and op_name  =  'Cancel'   and
                 g.instanceid=e.instance_id
                ) and IDE_TYP_TYP ='I' and
                i.KEY_ITM_NBR = t.KEY_ITM_NBR and
                ((g.ide_reg_dat between h.valid_from and h.valid_to) or   (g.ide_reg_dat > h.valid_from and   h.valid_to is null )) and  
                g.instanceid=i.instanceid and
                IDE_REG_DAT >= to_date('".date('Y/m/d',strtotime($data['fromDate']))."','yyyy/mm/dd') and
                IDE_REG_DAT <= to_date('".date('Y/m/d',strtotime($data['toDate']))."','yyyy/mm/dd') and
                CMP_CON_COD like '".substr($data['tinNoC'], 0, -4)."%'
                --CMP_FIS_COD
                group by DEC_COD,
                CMP_CON_COD,
                DEC_REF_YER,  
                IDE_CUO_COD,
                IDE_REG_SER,
                IDE_REG_NBR,
                 IDE_REG_DAT,
                  IDE_AST_DAT,
                   IDE_RCP_DAT,
                    IDE_TYP_SAD,  
                     GEN_CTY_EPT_NAM,
                     GDS_ORG_CTY,
                     i.KEY_ITM_NBR,
                     TAR_HSC_NB1,  
                     TAR_PRC_EXT,
                     TAR_PRC_NAT,
                     TAR_SUP_QTY,  
                     VIT_WGT_GRS,
                     VIT_WGT_NET,    
                     TAR_SUP_COD,    
                     VIT_STV";


        // $sql = "select distinct IDE_CUO_COD, IDE_CUO_NAM from awunadm.SAD_GENERAL_SEGMENT";
        $stid = oci_parse(Cli::$conn, $sql);
        // log_message('error','asyw'.json_encode(gettype($stid)));
        oci_execute($stid);
        return $stid;
    }


    public static function processQueryWorldExport($data){
        if (!Cli::$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $sql = "select DEC_COD,
              CMP_EXP_COD,
              DEC_REF_YER, 
              IDE_CUO_COD,
              IDE_REG_SER,
              IDE_REG_NBR,
               IDE_REG_DAT,
               IDE_AST_DAT,
                IDE_RCP_DAT,
                 IDE_TYP_SAD,
                  GEN_CTY_DES_COD,
                  GDS_ORG_CTY,
                     i.KEY_ITM_NBR,
                     TAR_HSC_NB1,
                      TAR_PRC_EXT,
                      TAR_PRC_NAT,
                      TAR_SUP_QTY,
                       VIT_WGT_NET,
                       VIT_STV,
                        SUM(CASE  WHEN t.TAX_LIN_COD ='TC1'  and tax_lin_mop = '1' THEN     t.TAX_LIN_AMT ELSE 0 END) TC1, 
                        SUM(CASE  WHEN t.TAX_LIN_COD = 'CC1'   and tax_lin_mop = '1' THEN    t.TAX_LIN_AMT ELSE 0 END) CC1,                    
                        SUM(CASE  WHEN t.TAX_LIN_COD ='RC'  and tax_lin_mop = '1' THEN       t.TAX_LIN_AMT ELSE 0 END) RC,                   
                        SUM(CASE  WHEN t.TAX_LIN_COD ='CED'   and tax_lin_mop = '1' THEN      t.TAX_LIN_AMT ELSE 0 END) CED,                   
                        SUM(CASE   WHEN  t.TAX_LIN_COD ='EEC'   and tax_lin_mop = '1' THEN       t.TAX_LIN_AMT ELSE 0 END)  EEC,                   
                        SUM(CASE   WHEN  t.TAX_LIN_COD ='TC2'  and tax_lin_mop = '1' THEN          t.TAX_LIN_AMT ELSE 0 END) TC2,                   
                        SUM(CASE   WHEN  t.TAX_LIN_COD ='RYL'   and tax_lin_mop = '1' THEN          t.TAX_LIN_AMT ELSE 0 END)  RYL               
                        from
             awunadm.sad_general_Segment g, awunadm.sad_item i
             LEFT OUTER JOIN   awunadm.SAD_Tax t ON i.instanceid=t.instanceid  and  i.KEY_ITM_NBR = t.KEY_ITM_NBR 
             LEFT OUTER JOIN   awunadm.sad_supplementary_unit s ON  i.instanceid=s.instanceid and i.key_itm_nbr=s.key_itm_nbr and key_sup_rnk=1
            where
            not EXISTS
            (SELECT *
            from  awunadm.UN_ASYBRK_TRACK k,   awunadm.UN_ASYBRK_IED e
            WHERE
             e.ied_id=k.ied_id  and op_name  =  'Cancel'   and
             g.instanceid=e.instance_id
            ) and
             IDE_TYP_TYP ='E' and
            g.instanceid=i.instanceid and
             IDE_REG_DAT >= to_date('".date('Y/m/d',strtotime($data['fromDate']))."','yyyy/mm/dd') and
              IDE_REG_DAT <= to_date('".date('Y/m/d',strtotime($data['toDate']))."','yyyy/mm/dd') and
              CMP_EXP_COD like '".substr($data['tinNoC'], 0, -4)."%'
            group by DEC_COD,
              CMP_EXP_COD,
              DEC_REF_YER, 
              IDE_CUO_COD,
              IDE_REG_SER,
              IDE_REG_NBR,
               IDE_REG_DAT,
               IDE_AST_DAT,
                IDE_RCP_DAT,
                 IDE_TYP_SAD,
                  GEN_CTY_DES_COD,
                  GDS_ORG_CTY,
                     i.KEY_ITM_NBR,
                     TAR_HSC_NB1,
                      TAR_PRC_EXT,
                      TAR_PRC_NAT,
                      TAR_SUP_QTY,
                       VIT_WGT_NET,
                       VIT_STV
                       order by 3,4,5,6,14
            ";


        // $sql = "select distinct IDE_CUO_COD, IDE_CUO_NAM from awunadm.SAD_GENERAL_SEGMENT";
        $stid = oci_parse(Cli::$conn, $sql);
        // log_message('error','asyw'.json_encode(gettype($stid)));
        oci_execute($stid);
        return $stid;
    }


    public static function processQueryWorldGrn($data){
        if (!Cli::$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $sql = "select DEC_COD,
                CMP_CON_COD,
                DEC_REF_YER,  
                IDE_CUO_COD,
                IDE_REG_SER,
                IDE_REG_NBR,
                IDE_REG_DAT,
                IDE_AST_DAT,
                IDE_RCP_DAT,  
                IDE_TYP_SAD,  
                TPT_MOT_DPA_NAM,    
                GEN_CTY_EPT_NAM,
                FIN_TOP_COD,
                GDS_ORG_CTY,
                 i.KEY_ITM_NBR,
                 TAR_HSC_NB1,  
                 h.TAR_DSC,  
                (cast(replace(replace(i.GDS_DSC,chr(10),' '),chr(13),' ') as VARCHAR2(100) )|| i.gds_ds3),
                 TAR_PRC_EXT,
                 TAR_PRC_NAT,
                 TAR_SUP_QTY,  
                 VIT_WGT_GRS,
                 VIT_WGT_NET,    
                 TAR_SUP_COD,    
                  VIT_STV,
                             SUM(CASE  WHEN t.TAX_LIN_COD ='CID'  and tax_lin_mop = '1' THEN     t.TAX_LIN_AMT ELSE 0 END) CID,  
                            SUM(CASE  WHEN t.TAX_LIN_COD = 'EIC'   and tax_lin_mop = '1' THEN    t.TAX_LIN_AMT ELSE 0 END) EIC,                     
                            SUM(CASE  WHEN t.TAX_LIN_COD ='PAL'  and tax_lin_mop = '1' THEN       t.TAX_LIN_AMT ELSE 0 END)PAL,                    
                            SUM(CASE  WHEN t.TAX_LIN_COD ='RDL'   and tax_lin_mop = '1' THEN      t.TAX_LIN_AMT ELSE 0 END) RDL,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='SCL'   and tax_lin_mop = '1' THEN       t.TAX_LIN_AMT ELSE 0 END)  SCL,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='SRL'  and tax_lin_mop = '1' THEN          t.TAX_LIN_AMT ELSE 0 END) SRL,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='SUR'   and tax_lin_mop = '1' THEN          t.TAX_LIN_AMT ELSE 0 END)  SUR,                    
                            SUM(CASE   WHEN  t.TAX_LIN_COD ='VAT'    and tax_lin_mop = '1' THEN        t.TAX_LIN_AMT ELSE 0 END)  VAT,
                            SUM(CASE  WHEN  t.TAX_LIN_COD ='NBT'  and tax_lin_mop = '1' THEN           t.TAX_LIN_AMT ELSE 0 END)  NBT,                    
                            SUM(CASE  WHEN  t.TAX_LIN_COD ='XID'   and tax_lin_mop = '1' THEN           t.TAX_LIN_AMT ELSE 0 END)  XID  from
                 awunadm.sad_general_Segment g, awunadm.sad_item i
                 LEFT OUTER JOIN   awunadm.SAD_Tax t ON i.instanceid=t.instanceid  and  i.KEY_ITM_NBR = t.KEY_ITM_NBR  
                 LEFT OUTER JOIN   awunadm.sad_supplementary_unit s ON  i.instanceid=s.instanceid and i.key_itm_nbr=s.key_itm_nbr and key_sup_rnk=1
                 LEFT OUTER JOIN   awunadm.UNTARTAB h ON h.hs6_cod || h.tar_pr1 = i.TAR_HSC_NB1
                where
                not EXISTS
                (SELECT *
                from  awunadm.UN_ASYBRK_TRACK k,   awunadm.UN_ASYBRK_IED e
                WHERE
                 e.ied_id=k.ied_id  and op_name  =  'Cancel'   and
                 g.instanceid=e.instance_id
                ) and IDE_TYP_TYP ='I' and
                i.KEY_ITM_NBR = t.KEY_ITM_NBR and
                ((g.ide_reg_dat between h.valid_from and h.valid_to) or   (g.ide_reg_dat > h.valid_from and   h.valid_to is null )) and  
                g.instanceid=i.instanceid and
                IDE_REG_DAT >= to_date('".date('Y/m/d',strtotime($data['fromDate']))."','yyyy/mm/dd') and
                IDE_REG_DAT <= to_date('".date('Y/m/d',strtotime($data['toDate']))."','yyyy/mm/dd') and
                CMP_FIS_COD like '".substr($data['tinNoC'], 0, -4)."%' and 
                CMP_FIS_COD != CMP_CON_COD
                group by DEC_COD,
                CMP_CON_COD,
                DEC_REF_YER,  
                IDE_CUO_COD,
                IDE_REG_SER,
                IDE_REG_NBR,
                 IDE_REG_DAT,
                  IDE_AST_DAT,
                   IDE_RCP_DAT,
                    IDE_TYP_SAD,  
                    TPT_MOT_DPA_NAM,    
                     GEN_CTY_EPT_NAM,
                     FIN_TOP_COD,
                     GDS_ORG_CTY,
                     i.KEY_ITM_NBR,
                     TAR_HSC_NB1,  
                     h.TAR_DSC,  
                     (cast(replace(replace(i.GDS_DSC,chr(10),' '),chr(13),' ') as VARCHAR2(100) )|| i.gds_ds3),
                     TAR_PRC_EXT,
                     TAR_PRC_NAT,
                     TAR_SUP_QTY,  
                     VIT_WGT_GRS,
                     VIT_WGT_NET,    
                     TAR_SUP_COD,    
                     VIT_STV";


        // $sql = "select distinct IDE_CUO_COD, IDE_CUO_NAM from awunadm.SAD_GENERAL_SEGMENT";
        $stid = oci_parse(Cli::$conn, $sql);
        // log_message('error','asyw'.json_encode(gettype($stid)));
        oci_execute($stid);
        return $stid;
    }



    public static function processQueryAsyPlusImport($data){
        // echo date('d-M-Y',strtotime($data['toDate']));
        // exit();
        if (!Cli::$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
                    $sql = "select 
                    g.key_dec as DECLARENT ,
                    g.sad_consignee as IM_TIN,
                    g.key_year as IM_YEAR,  
                    g.key_cuo as OFFICE,
                    g.sad_reg_serial as SER,
                    g.sad_reg_nber as REG_NO, 
                    g.sad_reg_date as REG_DATE, 
                    g.sad_asmt_date AS ASMT_DATE, 
                    g.sad_rcpt_date as RCPT_DATE,  
                    g.SAD_TYP_DEC as DTYPE,  
                    g.SAD_CTY_EXPCOD,
                    i.SADITM_CTY_ORIGCOD,
                    i.itm_nber,
                    i.saditm_hs_cod,
                    i.saditm_extd_proc as CPC, 
                    i.saditm_nat_proc as NPC, 
                    i.saditm_supp_units as S_Units, 
                    i.SADITM_GROSS_MASS as G_MASS, 
                    i.saditm_net_mass as N_MASS ,   
                    h.UOM_COD1 as UOM, 
                    i.saditm_stat_val as CIF_VALUE,
                    SUM(CASE  WHEN t.SADITM_TAX_CODE ='CID'  and SADITM_TAX_MOP = '1' THEN     t.SADITM_TAX_AMOUNT ELSE 0 END) CID,  
                    SUM(CASE  WHEN t.SADITM_TAX_CODE = 'EIC'   and SADITM_TAX_MOP = '1' THEN    t.SADITM_TAX_AMOUNT ELSE 0 END) EIC,                     
                    SUM(CASE  WHEN t.SADITM_TAX_CODE ='PAL'  and SADITM_TAX_MOP = '1' THEN       t.SADITM_TAX_AMOUNT ELSE 0 END)PAL,                    
                    SUM(CASE  WHEN t.SADITM_TAX_CODE ='RDL'   and SADITM_TAX_MOP = '1' THEN      t.SADITM_TAX_AMOUNT ELSE 0 END) RDL,                    
                    SUM(CASE   WHEN  t.SADITM_TAX_CODE ='SCL'   and SADITM_TAX_MOP = '1' THEN       t.SADITM_TAX_AMOUNT ELSE 0 END)  SCL,                    
                    SUM(CASE   WHEN  t.SADITM_TAX_CODE ='SRL'  and SADITM_TAX_MOP = '1' THEN          t.SADITM_TAX_AMOUNT ELSE 0 END) SRL,                    
                    SUM(CASE   WHEN  t.SADITM_TAX_CODE ='SUR'   and SADITM_TAX_MOP = '1' THEN          t.SADITM_TAX_AMOUNT ELSE 0 END)  SUR,                    
                    SUM(CASE   WHEN  t.SADITM_TAX_CODE ='VAT'    and SADITM_TAX_MOP = '1' THEN        t.SADITM_TAX_AMOUNT ELSE 0 END)  VAT, 
                    SUM(CASE  WHEN  t.SADITM_TAX_CODE ='NBT'  and SADITM_TAX_MOP = '1' THEN           t.SADITM_TAX_AMOUNT ELSE 0 END)  NBT,                    
                    SUM(CASE  WHEN  t.SADITM_TAX_CODE ='XID'   and SADITM_TAX_MOP = '1' THEN           t.SADITM_TAX_AMOUNT ELSE 0 END)  XID 
                        from sad_gen g, sad_itm i
                    LEFT OUTER JOIN  SAD_Tax t ON i.key_year=t.KEY_YEAR  and  i.key_cuo = t.key_cuo  and i.key_dec =t.key_dec and i.key_nber=t.key_nber and i.itm_nber=t.itm_nber and t.SAD_NUM=0
                    LEFT OUTER JOIN   UNTARTAB h ON h.hs6_cod || h.tar_pr1 = i.saditm_hs_cod
                    where 
                        i.sad_num=0 and
                        g.key_year  = i.key_year and
                        g.key_cuo  = i.key_cuo and
                        g.key_dec  = i.key_dec and
                        g.key_nber = i.key_nber and
                        g.sad_num=0 and
                        g.lst_ope != 'D'  and
                        g.sad_flw='1'and 
                        g.sad_reg_date >= to_date('".date('d-M-Y',strtotime($data['fromDate']))."','dd-mm-yyyy') and
                        g.sad_reg_date <= to_date('".date('d-M-Y',strtotime($data['toDate']))."','dd-mm-yyyy') and
                        ((g.sad_reg_date between h.EEA_DOV and h.EEA_EOV) or   (g.sad_reg_date > h.EEA_DOV and   h.EEA_EOV is null )) and  
                        h.lst_ope != 'D' and 
                        h.hs6_cod || h.tar_pr1 = i.saditm_hs_cod and
                        g.sad_consignee like '".substr($data['tinNoC'], 0, -4)."%'
                        group by 
                        g.key_dec ,
                        g.sad_consignee, 
                        g.key_year,
                        g.key_cuo, 
                        g.sad_reg_serial,
                        g.sad_reg_nber, 
                        g.sad_reg_date, 
                        g.sad_asmt_date, 
                        g.sad_rcpt_date, 
                        g.SAD_TYP_DEC,
                        g.SAD_CTY_EXPCOD,
                        i.SADITM_CTY_ORIGCOD,
                        i.itm_nber,
                        i.saditm_hs_cod, 
                        i.saditm_extd_proc, 
                        i.saditm_nat_proc, 
                        i.saditm_supp_units, 
                        i.SADITM_GROSS_MASS,  
                        i.saditm_net_mass ,
                        h.UOM_COD1,
                        i.saditm_stat_val";

                        // echo $sql;
                        // exit();
        $stid = oci_parse(Cli::$conn, $sql);
        // log_message('error','asy++'.json_encode(gettype($stid)));
        oci_execute($stid);
        return $stid;
    }



    public static function processQueryAsyPlusExport($data){
        if (!Cli::$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
                    $sql = "select g.key_dec as Declarant ,
                             g.sad_Exporter as Exporter,
                              g.key_year as Year,
                              g.key_cuo as Office ,
                              g.sad_reg_serial as Ser,
                              g.sad_reg_nber as Reg_No,
                               g.sad_reg_date as Reg_Date,
                               g.sad_asmt_date as Asmt_Date,
                               g.sad_rcpt_date As Rcpt_Date,
                               g.SAD_TYP_DEC as Type1,
                               g.SAD_CTY_DESTCOD as Dest_Country,
                               i.SADITM_CTY_ORIGCOD as ORG_Country,
                               i.itm_nber as Item_No,
                               i.saditm_hs_cod as HS,
                               i.saditm_extd_proc as CPC,
                               i.saditm_nat_proc as NPC,
                               i.saditm_supp_units as Sup_Unit,
                               i.saditm_net_mass as Net_Mass ,
                               i.saditm_stat_val as FOB,
                                SUM(CASE  WHEN t.SADITM_TAX_CODE = 'TC1'  and SADITM_TAX_MOP=  '1' THEN     t.SADITM_TAX_AMOUNT ELSE 0 END) TC1,
                                SUM(CASE  WHEN t.SADITM_TAX_CODE=  'CC1'   and SADITM_TAX_MOP=  '1' THEN    t.SADITM_TAX_AMOUNT ELSE 0 END) CC1,
                                SUM(CASE  WHEN t.SADITM_TAX_CODE= 'RC'  and SADITM_TAX_MOP=  '1' THEN       t.SADITM_TAX_AMOUNT ELSE 0 END) RC,
                                SUM(CASE  WHEN t.SADITM_TAX_CODE= 'CED'   and SADITM_TAX_MOP = '1' THEN      t.SADITM_TAX_AMOUNT ELSE 0 END) CED,
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE= 'EEC'   and SADITM_TAX_MOP=  '1' THEN       t.SADITM_TAX_AMOUNT ELSE 0 END)  EEC,
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE= 'TC2'  and SADITM_TAX_MOP=  '1' THEN          t.SADITM_TAX_AMOUNT ELSE 0 END) TC2,
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE= 'RYL'   and SADITM_TAX_MOP=  '1' THEN          t.SADITM_TAX_AMOUNT ELSE 0 END)  RYL
                                from sad_gen g, sad_itm i
                                LEFT OUTER JOIN  SAD_Tax t ON i.key_year=t.KEY_YEAR  and  i.key_cuo=  t.key_cuo  and i.key_dec= t.key_dec and i.key_nber=t.key_nber and i.itm_nber=t.itm_nber and t.SAD_NUM=0
                                where i.sad_num=0 and g.key_year=   i.key_year and g.key_cuo =  i.key_cuo and g.key_dec=   i.key_dec and
                                g.key_nber=  i.key_nber and g.sad_num=0 and g.lst_ope != 'D'  and g.sad_flw='0'and
                                g.sad_reg_date >=  to_date('".date('d-M-Y',strtotime($data['fromDate']))."','dd-mm-yyyy') and
                                g.sad_reg_date <= to_date('".date('d-M-Y',strtotime($data['toDate']))."','dd-mm-yyyy') and
                                g.sad_Exporter like '".substr($data['tinNoC'], 0, -4)."%'
                                group by g.key_dec ,g.sad_Exporter, g.key_year,g.key_cuo, g.sad_reg_serial,g.sad_reg_nber, g.sad_reg_date, g.sad_asmt_date, g.sad_rcpt_date, g.SAD_TYP_DEC,g.SAD_CTY_DESTCOD,i.SADITM_CTY_ORIGCOD,i.itm_nber,i.saditm_hs_cod,  i.saditm_extd_proc, i.saditm_nat_proc, i.saditm_supp_units,  i.saditm_net_mass ,i.saditm_stat_val
                                order by g.key_year,g.key_cuo, g.sad_reg_serial,g.sad_reg_nber,i.itm_nber
";

        $stid = oci_parse(Cli::$conn, $sql);
        oci_execute($stid);
        return $stid;
    }

    public static function processQueryAsyPlusGrn($data){
        if (!Cli::$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
                    $sql = "select 
                    g.key_dec as DECLARENT ,
                    g.sad_consignee as IM_TIN,
                     g.key_year as IM_YEAR,  
                    g.key_cuo as OFFICE,
                    g.sad_reg_serial as SER,
                    g.sad_reg_nber as REG_NO, 
                    g.sad_reg_date as REG_DATE, 
                    g.sad_asmt_date AS ASMT_DATE, 
                    g.sad_rcpt_date as RCPT_DATE,  
                    g.SAD_TYP_DEC as DTYPE,  
                    g.SAD_TRSP_IDDEPAR ,
                    g.SAD_CTY_EXPCOD,
                    g.sad_top_cod as  MOP,
                    i.SADITM_CTY_ORIGCOD,
                    i.itm_nber,
                    i.saditm_hs_cod,
                    h.TAR_DSC, 
                    (i.SADITM_GOODS_DESC1||i.SADITM_GOODS_DESC2|| i.SADITM_GOODS_DESC3) as DESCRIPTION,   
                    i.saditm_extd_proc as CPC, 
                    i.saditm_nat_proc as NPC, 
                    i.saditm_supp_units as S_Units, 
                    i.SADITM_GROSS_MASS as G_MASS, 
                    i.saditm_net_mass as N_MASS ,   
                    h.UOM_COD1 as UOM, 
                    i.saditm_stat_val as CIF_VALUE,
                                 SUM(CASE  WHEN t.SADITM_TAX_CODE ='CID'  and SADITM_TAX_MOP = '1' THEN     t.SADITM_TAX_AMOUNT ELSE 0 END) CID,  
                                SUM(CASE  WHEN t.SADITM_TAX_CODE = 'EIC'   and SADITM_TAX_MOP = '1' THEN    t.SADITM_TAX_AMOUNT ELSE 0 END) EIC,                     
                                SUM(CASE  WHEN t.SADITM_TAX_CODE ='PAL'  and SADITM_TAX_MOP = '1' THEN       t.SADITM_TAX_AMOUNT ELSE 0 END)PAL,                    
                                SUM(CASE  WHEN t.SADITM_TAX_CODE ='RDL'   and SADITM_TAX_MOP = '1' THEN      t.SADITM_TAX_AMOUNT ELSE 0 END) RDL,                    
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE ='SCL'   and SADITM_TAX_MOP = '1' THEN       t.SADITM_TAX_AMOUNT ELSE 0 END)  SCL,                    
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE ='SRL'  and SADITM_TAX_MOP = '1' THEN          t.SADITM_TAX_AMOUNT ELSE 0 END) SRL,                    
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE ='SUR'   and SADITM_TAX_MOP = '1' THEN          t.SADITM_TAX_AMOUNT ELSE 0 END)  SUR,                    
                                SUM(CASE   WHEN  t.SADITM_TAX_CODE ='VAT'    and SADITM_TAX_MOP = '1' THEN        t.SADITM_TAX_AMOUNT ELSE 0 END)  VAT, 
                                SUM(CASE  WHEN  t.SADITM_TAX_CODE ='NBT'  and SADITM_TAX_MOP = '1' THEN           t.SADITM_TAX_AMOUNT ELSE 0 END)  NBT,                    
                                SUM(CASE  WHEN  t.SADITM_TAX_CODE ='XID'   and SADITM_TAX_MOP = '1' THEN           t.SADITM_TAX_AMOUNT ELSE 0 END)  XID from
                     sad_gen g, sad_itm i
                    LEFT OUTER JOIN  SAD_Tax t ON i.key_year=t.KEY_YEAR  and  i.key_cuo = t.key_cuo  and i.key_dec =t.key_dec and i.key_nber=t.key_nber and i.itm_nber=t.itm_nber and t.SAD_NUM=0
                    LEFT OUTER JOIN   UNTARTAB h ON h.hs6_cod || h.tar_pr1 = i.saditm_hs_cod
                     where 
                     i.sad_num=0 and
                    g.key_year  = i.key_year and
                    g.key_cuo  = i.key_cuo and
                    g.key_dec  = i.key_dec and
                    g.key_nber = i.key_nber and
                    g.sad_num=0 and
                    g.lst_ope != 'D'  and
                    g.sad_flw='1'and 
                    g.sad_reg_date >= to_date('".date('d-M-Y',strtotime($data['fromDate']))."','dd-mm-yyyy') and
                    g.sad_reg_date <= to_date('".date('d-M-Y',strtotime($data['toDate']))."','dd-mm-yyyy') and
                    ((g.sad_reg_date between h.EEA_DOV and h.EEA_EOV) or   (g.sad_reg_date > h.EEA_DOV and   h.EEA_EOV is null )) and  
                    h.lst_ope != 'D' and 
                    h.hs6_cod || h.tar_pr1 = i.saditm_hs_cod and
                    g.sad_financial like '".substr($data['tinNoC'], 0, -4)."%' and 
                    g.sad_consignee != g.sad_financial
                    group by 
                    g.key_dec ,
                    g.sad_consignee, 
                    g.key_year,
                    g.key_cuo, 
                    g.sad_reg_serial,
                    g.sad_reg_nber, 
                    g.sad_reg_date, 
                    g.sad_asmt_date, 
                    g.sad_rcpt_date, 
                    g.SAD_TYP_DEC,
                    g.SAD_TRSP_IDDEPAR,  
                    g.SAD_CTY_EXPCOD,
                    g.sad_top_cod ,
                    i.SADITM_CTY_ORIGCOD,
                    i.itm_nber,
                    i.saditm_hs_cod, 
                    h.TAR_DSC,
                     (i.SADITM_GOODS_DESC1||i.SADITM_GOODS_DESC2||i.SADITM_GOODS_DESC3),   
                     i.saditm_extd_proc, 
                     i.saditm_nat_proc, 
                     i.saditm_supp_units, 
                     i.SADITM_GROSS_MASS,  
                     i.saditm_net_mass ,
                     h.UOM_COD1,
                        i.saditm_stat_val";

                        // echo $sql;
                        // exit();
        $stid = oci_parse(Cli::$conn, $sql);
        // log_message('error','asy++'.json_encode(gettype($stid)));
        oci_execute($stid);
        return $stid;
    }

    public static function doGenerateQueryReport($job){
        Cli::$startTime = microtime();
        $data = unserialize($job->workload());

        Cli::$userid = $data['userid'];
        Cli::$filename = $data['filenameq'];

        Cli::$rec_id = $data['rec_id'];

        $sheet_arr = array();
        if(isset($data['db_55']) && $data['db_55']!=null){
            Cli::connectServer(55);
            $stid_55 = Cli::processQueryAll($data['asyw_query']);
            array_push($sheet_arr, $stid_55);
        }
        if(isset($data['db_43']) && $data['db_43']!=null){
            Cli::connectServer(43);
            $stid_43 = Cli::processQueryAll($data['asyw_query']);
            array_push($sheet_arr, $stid_43);
        }
        if(isset($data['db_208']) && $data['db_208']!=null){
            Cli::connectServer(208);
            $stid_208 = Cli::processQueryAll($data['asyp_query']);
            array_push($sheet_arr, $stid_208);
        }
        if(isset($data['db_234']) && $data['db_234']!=null){
            Cli::connectServer(234);
            $stid_234 = Cli::processQueryAll($data['asyp_query']);
            array_push($sheet_arr, $stid_234);
        }
        if(isset($data['db_236']) && $data['db_236']!=null){
            Cli::connectServer(236);
            $stid_236 = Cli::processQueryAll($data['asyp_query']);
            array_push($sheet_arr, $stid_236);
        }
        if(isset($data['db_203']) && $data['db_203']!=null){
            Cli::connectServer(203);
            $stid_203 = Cli::processQueryAll($data['asyp_query']);
            array_push($sheet_arr, $stid_203);
        }
        if(isset($data['db_70']) && $data['db_70']!=null){
            Cli::connectServer(70);
            $stid_70 = Cli::processQueryAll($data['asyp_query']);
            array_push($sheet_arr, $stid_70);
        }
        
        
        
        
        return Cli::generateExcel(null,null,null,array('sheet'=>$sheet_arr,'sheetName'=>'detail'));
    }

    public static function processQueryAll($sql){
        $sql = str_replace(";"," ",$sql);
        $stid = oci_parse(Cli::$conn, $sql);
        oci_execute($stid);
        return $stid;
    }




    public static function generateExcel($stidArr_im=null,$stidArr_ex=null,$stidArr_grn=null,$detail=null){


        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array( 'memoryCacheSize' => '512MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);

        $objPHPExcel = new PHPExcel();
        
        $objPHPExcel->getProperties()->setCreator("ICT - STATISTIC UNIT")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");

        if($detail != null && (isset($detail['sheet']) && !empty($detail['sheet']))){
            $objPHPExcel->setActiveSheetIndex(0);
            $ncols = oci_num_fields($detail['sheet'][0]);
            $letter = "A";
            $increment = 1;
            $style_configurator_last_ltr = '';
            
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($detail['sheet'][0], $i);
                $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$colname !== null ? htmlentities($colname, ENT_QUOTES) : " ");
                $style_configurator_last_ltr = $letter;
                $letter++;
            }

            $increment = 2; 
            foreach($detail['sheet'] as $stid){
                while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    $letter = "A";
                    if(!empty($row) && count($row)>0){
                    foreach ($row as $item) {
                        $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$item !== null ? htmlentities($item, ENT_QUOTES) : " ");
                        $letter++;
                    }
                }
                        $increment++;
                }
                $increment++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$style_configurator_last_ltr.'1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setTitle('Detail');
        }




        if($stidArr_im!=null ){
            $objPHPExcel->setActiveSheetIndex(0);
            $ncols = oci_num_fields($stidArr_im[0]);
            $letter = "A";
            $increment = 1;
            $style_configurator_last_ltr = '';
            
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($stidArr_im[0], $i);
                $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$colname !== null ? htmlentities($colname, ENT_QUOTES) : " ");
                $style_configurator_last_ltr = $letter;
                $letter++;
            }

            $increment = 2; 
            foreach($stidArr_im as $stid){
                while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    
                    // log_message('error',json_encode($row));
                    $letter = "A";
                    if(!empty($row) && count($row)>0){
                        foreach ($row as $item) {
                            $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$item !== null ? htmlentities($item, ENT_QUOTES) : " ");
                            $letter++;
                        }
                    }
                    
                        $increment++;
                }
                $increment++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$style_configurator_last_ltr.'1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setTitle('Import');
        }
        if($stidArr_ex!=null){
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(1);

            $ncols = oci_num_fields($stidArr_ex[0]);
            $letter = "A";
            $increment = 1;
            $style_configurator_last_ltr = '';
            
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($stidArr_ex[0], $i);
                $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$colname !== null ? htmlentities($colname, ENT_QUOTES) : " ");
                $style_configurator_last_ltr = $letter;
                $letter++;
            }

            $increment = 2; 
            foreach($stidArr_ex as $stid){
                while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    $letter = "A";
                    if(!empty($row) && count($row)>0){
                    foreach ($row as $item) {
                        $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$item !== null ? htmlentities($item, ENT_QUOTES) : " ");
                        $letter++;
                    }
                }
                        $increment++;
                }
                $increment++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$style_configurator_last_ltr.'1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setTitle('Export');
        }
        if($stidArr_grn!=null){
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(2);

            $ncols = oci_num_fields($stidArr_grn[0]);
            $letter = "A";
            $increment = 1;
            $style_configurator_last_ltr = '';
            
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($stidArr_grn[0], $i);
                $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$colname !== null ? htmlentities($colname, ENT_QUOTES) : " ");
                $style_configurator_last_ltr = $letter;
                $letter++;
            }

            $increment = 2; 
            foreach($stidArr_grn as $stid){
                while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    $letter = "A";
                    if(!empty($row) && count($row)>0){
                        foreach ($row as $item) {
                            $objPHPExcel->getActiveSheet()->setCellValue($letter.$increment,$item !== null ? htmlentities($item, ENT_QUOTES) : " ");
                            $letter++;
                        }
                    }
                        $increment++;
                }
                $increment++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$style_configurator_last_ltr.'1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setTitle('GRN');
        }



        $objPHPExcel->setActiveSheetIndex(0);

        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        

        $report_name = microtime(true).'__'.Cli::$filename.'.xlsx';
        Cli::$endTime = microtime();
        $fullTime = Cli::$endTime - Cli::$startTime;
        $objWriter->save(__DIR__.'/../../public/uploads/genr/'.$report_name);

        $id = Cli::$rec_id;
        Cli::storegf($report_name,BASEURL.'public/uploads/genr/'.$report_name,$fullTime,$id);
        $return['report_name'] = $report_name;
        $return['time'] = $fullTime;
        return $return;
        exit;
    }

    public static function storegf($filename,$file,$execution_time,$id){
        $status = 1;
        $sql = "UPDATE generatedFiles set filename = ?, file = ?, execution_time = ?, status = ? WHERE id =?";
        $params = array($filename,$file,$execution_time,$status,$id);
        $CI =& get_instance();
        $query = $CI->db->query($sql,$params);
        return true;
    }


    public static function generateCustomAsyW($data){
        $sheet_arr = array();
        Cli::connectServer(43);
        $stid_43 = Cli::processQueryAll($data['asyw_query']);
        Cli::connectServer(55);
        $stid_55 = Cli::processQueryAll($data['asyw_query']);

        array_push($sheet_arr, $stid_55);
        return Cli::generateExcel(null,null,null,array('sheet'=>$sheet_arr,'sheetName'=>'detail'));
    }

    public static function generateCustomAsyP($data){
        $this->connectServer(208);
        $stid_208 = $this->processQueryAll($data['asyp_query']);
        $this->generateDemoTable($stid_208);
    }

    public static function delSelQuery($id){
        $sql = "delete from premade_queryies WHERE id=?";
        $params = array($id);
        $CI =& get_instance();
        $CI->db->query($sql,$params);
        return true;
    }
    
    public function worker()
    {
        $worker = $this->lib_gearman->gearman_worker();

        $this->lib_gearman->add_worker_function('generateReport', 'Cli::doGenerateReport');
        $this->lib_gearman->add_worker_function('generateQueryReport', 'Cli::doGenerateQueryReport');

        while ($this->lib_gearman->work()) {
            if (!$worker->returnCode()) {
                echo "worker done successfully \n";
            }
            if ($worker->returnCode() != GEARMAN_SUCCESS) {
                echo "return_code: " . $this->lib_gearman->current('worker')->returnCode() . "\n";
                break;
            }
        }
    }
}
