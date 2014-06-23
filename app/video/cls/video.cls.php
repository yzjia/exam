<?php

class user_user
{
	public $G;

	public function __construct(&$G)
	{
		$this->G = $G;
	}

	public function _init()
	{
		$this->sql = $this->G->make('sql');
		$this->db = $this->G->make('db');
		$this->pg = $this->G->make('pg');
		$this->ev = $this->G->make('ev');
		$this->module = $this->G->make('module');
		$this->session = $this->G->make('session');
	}

	//user function
	public function insertVideo($args)
	{
		$data = array('video',$args);
		$sql = $this->sql->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	public function modifyVideoInfo($args,$videoid)
	{
		if(!$args)return false;
		$data = array('video',$args,"videoid = '{$videoid}'");
		$sql = $this->sql->makeUpdate($data);
		$this->db->exec($sql);
		return $this->db->affectedRows();
	}

	public function delVideoById($videoid)
	{
		$data = array('video',"videoid = '{$videoid}'");
		$sql = $this->sql->makeDelete($data);
		$this->db->exec($sql);
		return $this->db->affectedRows();
	}

	public function getVideoById($id)
	{
		$data = array(false,'video',"videoid = '{$id}'");
		$sql = $this->sql->makeSelect($data);
		return $this->db->fetch($sql,'video');
	}

	public function getVideosByArgs($args)
	{
		$data = array(false,'video',$args);
		$sql = $this->sql->makeSelect($data);
		return $this->db->fetchAll($sql,'videoid','video');
	}

	public function getVideoListByArgs($page,$args,$number = 10)
	{
		$args = array(
			'table' => 'video',
			'query' => $args,
			'serial' => 'userinfo',
			'index' => 'videoid'
		);
		return $this->db->listElements($page,$number,$args);
	}

	public function getVideoList($page,$number = 20,$args = 1)
	{
		$page = $page > 0?$page:1;
		$r = array();
		$data = array(false,'video',$args,false,'videoid DESC',array(intval($page-1)*$number,$number));
		$sql = $this->sql->makeSelect($data);
		$r['data'] = $this->db->fetchALL($sql,false,false);
		$data = array('COUNT(*) AS number','video',$args,false,false,false);
		$sql = $this->sql->makeSelect($data);
		$tmp = $this->db->fetch($sql);
		$r['number'] = $tmp['number'];
		$pages = $this->pg->outPage($this->pg->getPagesNumber($tmp['number'],$number),$page);
		$r['pages'] = $pages;
		return $r;
	}
}

?>
