<template>
  <div class="wrapper">
      <div class="container">
        <div class="row">
          	<div class="col">
      			<div class="navbar navbar-inverse navbar-fixed-top">
        			<div class="container-fluid">
          				<div class="navbar-header">
            				<a class="navbar-brand" href="#">WebSiteName</a>
          				</div>
          				<ul class="nav navbar-nav navbar-left">
            				<li><a href="#">Main</a></li>
            				<li><a href="#">Book</a></li>
            				<li><a href="#">Shop</a></li>
           					<li class="add-gutter-top"><input type="text" name="searchbar"  class="form-control"></li>
                  			<li class="add-gutter-top"><button type="submit" class="btn btn-default">Search</button></li>
         			 	</ul>
          				<ul class="nav navbar-nav navbar-right">
           					<li><a href="#">Sign up</a></li>
            				<li><a href="#">Log In</a></li>
          				</ul>
        			</div>
        		</div>
        		<div class="clearfix"></div>
      		</div>
      	</div>
     	<div class="row banner">
          <div class="col">
            <div id="myCarousel" class="carousel slide">
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <img src="Kitchenware.png" alt="Back 1" class="backheader">
                </div>
                <div class="item">
                  <img src="kitchen.jpg" alt="Back 2" class="backheader">
                </div>
                <div class="item">
                  <img src="kitchen-2.jpg" alt="Back 3" class="backheader">
                </div>
                <div class="item">
                  <img src="kitchen-3.jpg" alt="Back 3" class="backheader">
                </div>
                <div class="item">
                  <img src="wall2.jpg" alt="Back 3" class="backheader">
                </div>
              </div>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
              </a>
          	</div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="row">
        <div class="col">
        <div class="left-floating">
          <ul class="list-unstyled">
            <li><a href="#">Wearable</a></li>
            <li><a href="#">Cutlery</a></li>
            <li><a href="#">Utensils</a></li>
            <li><a href="#">Electronics</a></li>
          </ul>
          </div>
        </div>
      </div>
    <main>
        <router-view></router-view>
    </main>
    <footer>
      <div class="container">
          <div class="row">
          <div class="col-sm-2">
            <h1 class="center" style="font-family: Calibri, sans-serif; width: 100%; border: 2px solid white;">Logo</h1>
          </div>
          <div class="col-sm-2">
            <h3>Contact Us</h3>
            <ul>
              <li>Phone : 082153012939</li>
              <li>Line  : MakanMakan</li>
              <li>WA    : 082153017777</li>
            </ul>
          </div>
          <div class="col-sm-2">
            <h3>Related Links</h3>
            <ul>
              <li><a href="#">link 1</a></li>
              <li><a href="#">link 2</a></li>
              <li><a href="#">link 3</a></li>
              <li><a href="#">link 4</a></li>
              <li><a href="#">link 5</a></li>
              <li><a href="#">link 6</a></li>
            </ul>
          </div>
          <div class="col-sm-6">
            <h3>Form</h3>
            <form class="" action="index.html" method="post">
              name     : <input class="black" type="text" name="name" value=""> <br/><br/>
              email    : <input class="black" type="text" name="email" value=""><br/><br/>
              complain : <textarea class="black" type="text" name="complain" value="" style="height: 10%; width: 100%;"> </textarea>
            </form>
          </div>
        </div>
        </div>
    </footer>
  </div>
</template>
