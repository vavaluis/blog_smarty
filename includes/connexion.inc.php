<?php
	session_start();
	ini_set('display_errors','off');
	mysql_connect('localhost','root','lprsc');
	mysql_select_db('blog_cv');
	mysql_query("SET NAMES utf8");
