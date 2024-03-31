<?php
/**
 * Created by PhpStorm.
 * User: MewMew
 * Date: 3/6/2019
 * Time: 7:27
 */

class ViewMovies
{
    public function getPageHome($data){
        include_once "Templates/index.php";
    }
    public function getDetailPagePhim($movie,$arr,$episode_movie){
        include_once "Templates/detail.php";
    }
    public function getPageMovie($data,$arr){
        include_once "Templates/pageMovie.php";
    }
    public function getPageContact(){
        include_once "Templates/contact.php";
    }
    public function getPageLogin(){
        include_once "Templates/FormLogin.php";
    }
    public function getPageRegister(){
        include_once "Templates/FormRegister.php";
    }

    public function getPageSearch($data,$arr){

    include_once "Templates/formTimKiem.php";

   

        
       
    }
    // quản lý user
    public function getPageUser($listUser){
        include_once "Templates/pageUserForAdmin.php";
    }
    // quản lý sản phẩm
    public function getPageMovieForAdmin($listMovies,$arr){
        include_once "Templates/pageMovieForAdmin.php";
    }
    public function getPageAddEp($result,$missingEpisodes){
        include_once "Templates/addEpisode.php";
    }
    public function getPageEditMovie($result){
        include_once "Templates/FormEditMovie.php";
    }
    public function getPageEditEpisode($result,$episodesUrl){
        include_once "Templates/FormEditEpisode.php";
    }
}