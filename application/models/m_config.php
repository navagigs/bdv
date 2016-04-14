<?php
class M_config extends CI_Model  {

    function __contsruct(){
        parent::Model();
    }
	
	function statistik() {
		$ip=$_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('Asia/Jakarta');
		$tanggal= date("Y-m-d");
		$batas=time();
		$cek=$this->db->query("SELECT * FROM statistik WHERE statistik_ip='".$ip."' AND statistik_tanggal='$tanggal'");
		if($cek->num_rows()<1){
			$this->db->insert('statistik',array('statistik_ip'=>$ip,'statistik_tanggal'=>$tanggal,'statistik_hits'=>1,'statistik_kunjungan'=>$batas));
		}
		else
		{
			$this->db->query("UPDATE statistik SET statistik_tanggal='".$tanggal."', statistik_hits=statistik_hits + 1, statistik_kunjungan=".$batas." WHERE statistik_ip='".$ip."' AND statistik_tanggal='".$tanggal."'");
		}
		$pengunjung=$this->db->where('statistik_tanggal',$tanggal)->group_by('statistik_ip')->get('statistik')->num_rows();
		$t_pengunjung=$this->db->query("SELECT COUNT('statistik_hits') as jum FROM statistik");
		$rowt=$t_pengunjung->row();
		//hits hari ini
		$hits=$this->db->query("SELECT SUM(statistik_hits) as hitstoday FROM statistik WHERE statistik_tanggal='$tanggal' GROUP BY statistik_tanggal");
		$hitsnya=$hits->row();
		//total hits
		$t_hits=$this->db->select_sum('statistik_hits')->get('statistik');
		$rowthits=$t_hits->row();
		
		// User Online
		$bataswaktu = time() - 300;
		$p_online = $this->db->query("SELECT * FROM statistik WHERE statistik_kunjungan > '$bataswaktu'");
		$online = $p_online->num_rows();
		
		echo '<ul class="ulstatistik">';
			echo '<li class="Hari-ini">Pengunjung Hari ini : <strong>'.$pengunjung.'</strong></li>';
			echo '<li class="Total">Total Pengunjung : <strong>'.$rowt->jum.'</strong></li>';
			echo '<li class="Hari-ini">Hits hari ini : <strong>'.$hitsnya->hitstoday.'</strong></li>';
			echo '<li class="Total">Total hits : <strong>'.$rowthits->statistik_hits.'</strong></li>';
			echo '<li class="Hari-ini">Online : <strong>'.$online.'</strong></li>';
		echo '</ul>';	
	}
	
	 /* function identitas_tittle()
	{
		return 'SMKN 4 PADALARANG';
	}
	
	//Configurasi PPTKIS
	public function new_no_pptkis(){
		@date_default_timezone_set('Asia/Jakarta');
		$this->db->select("pptkis_id_reg");
        $this->db->from("pptkis");
		$this->db->like('pptkis_tanggal_entry', date("Y"), 'after'); 
        $this->db->order_by("pptkis_id_reg","DESC");
		$this->db->limit(1);
		$Q = $this->db->get();
		$row = $Q->row();
		$lasNomor = ($Q->num_rows() < 1)?'0':$row->pptkis_id_reg;
		$tahun = date("Y");
		$bulan = date("m");
		$oi = substr($lasNomor, 0, 4);
		
		$auto = $oi + 1;
		
		$digit1 = (int) ($auto % 10);
		$digit2 = (int) (($auto % 100) / 10);
		$digit3 = (int) (($auto % 1000) / 100);
		$digit4 = (int) (($auto % 10000) / 1000);			
		$autonew = "$digit4"."$digit3"."$digit2"."$digit1"."$bulan"."$tahun";
		return $autonew;
	}
	
	//Configurasi JOB ORDER
	public function new_no_job_order(){
		$this->db->select("job_order_kode");
        $this->db->from("job_order");
        $this->db->order_by("job_order_kode","DESC");
		$this->db->limit(1);
		$Q = $this->db->get();
		$row = $Q->row();
		$lasNomor = ($Q->num_rows() < 1)?'0':$row->job_order_kode;
		$oi = substr($lasNomor,3,4);
		
		$auto = $oi + 1;
		
		$digit1 = (int) ($auto % 10);
		$digit2 = (int) (($auto % 100) / 10);
		$digit3 = (int) (($auto % 1000) / 100);
		$digit4 = (int) (($auto % 10000) / 1000);			
		$autonew = "JO-"."$digit4"."$digit3"."$digit2"."$digit1";
		return $autonew;
	}
	
	//Configurasi SPR
	public function new_no_spr(){
		$this->db->select("spr_kode");
        $this->db->from("spr");
        $this->db->order_by("spr_kode","DESC");
		$this->db->limit(1);
		$Q = $this->db->get();
		$row = $Q->row();
		$lasNomor = ($Q->num_rows() < 1)?'0':$row->spr_kode;
		$oi = substr($lasNomor,4,4);
		
		$auto = $oi + 1;
		
		$digit1 = (int) ($auto % 10);
		$digit2 = (int) (($auto % 100) / 10);
		$digit3 = (int) (($auto % 1000) / 100);
		$digit4 = (int) (($auto % 10000) / 1000);			
		$autonew = "SPR-"."$digit4"."$digit3"."$digit2"."$digit1";
		return $autonew;
	}
	
	//Configurasi NEGARA
	public function new_no_negara(){
		$this->db->select("negara_kode");
        $this->db->from("negara");
        $this->db->order_by("negara_kode","DESC");
		$this->db->limit(1);
		$Q = $this->db->get();
		$row = $Q->row();
		$lasNomor = ($Q->num_rows() < 1)?'0':$row->negara_kode;
		$oi = substr($lasNomor,0,3);
		
		$auto = $oi + 1;
		
		$digit1 = (int) ($auto % 10);
		$digit2 = (int) (($auto % 100) / 10);
		$digit3 = (int) (($auto % 1000) / 100);
		$autonew = "$digit3"."$digit2"."$digit1";
		return $autonew;
	}
	
	// AUTUCOMPLETE
	public function lookup_pejabat_sip_nama($keyword){
		$this->db->select('*');
		$this->db->from('pejabat_sip');
		$this->db->like('pejabat_sip_nama',$keyword,'both');
		$this->db->order_by('pejabat_sip_nama', 'ASC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function datediff($tgl1, $tgl2){
		$tgl1 = strtotime($tgl1);
		$tgl2 = strtotime($tgl2);
		$diff_secs = $tgl1 - $tgl2;
		$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array( "years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1);
	} */
	
	public function seo($s) {
		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
	
		$s = str_replace($d, '', $s);
		
		$s = strtolower(str_replace($c, '-', $s));
		return $s;
	}
}