<?php 
echo(
  '<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">JunkMart</a>
      </div>
      <form class="navbar-form col-md-6" role="search" action="/search", method="post">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" id="query" name="query"/>
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="/profile">
              <span class="glyphicon glyphicon-user"></span>
              <span>Your Account</span>
            </a>
          </li>
          <li>
            <a href="/cart">
              <span class="glyphicon glyphicon-shopping-cart"></span>
		      <span>Cart</span>
            </a>
          </li>
          <li>
            <a href="/login">Log In</a> 
          </li>
        </ul>
      </div>
    </div>
  </nav>'); ?>