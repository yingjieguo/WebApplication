
@extends('vendor.main')

@section('title','| About')

@section('content')
{{-- <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h1>About Me</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis aspernatur quas quibusdam veniam sunt animi, est quos optio explicabo deleniti inventore unde minus, tempore enim ratione praesentium, cumque, dolores nesciunt?</p>
        </div>
      </div>

    </div> --}}

    <div class="container">
        <div class="text-center">
            <h1>THE PROJECT</h1>
            <h3><em>We love coding!</em></h3>
        </div>
        <div  class="container col-sm-12">
            <p>In this project, we used PHP Laravel to build a functional blog. In this blog, you can talk about your creative ideas, your every thought. You can share your blogs with everyone in the world, and also you can choose to hide this blog from yourself. Besides, there is another important feature in our blog. You can post blogs without others' knowing that's your blog. From this feature, you can share your secrets with other people, and get useful help about some awkwark questions.</p>
            <p>We encourage you to try out blogs first before making any decision, because we have it all!!!!!!!!!</p>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <p><strong>Zhen Cheng:</strong></p>
                <br>
                <a href="#demo" data-toggle="collapse">
                    <img src="IMG_0379.JPG" class="img-circle" alt="Random Name" width="120" height="120">
                </a>
                <div id="demo" class="collapse">
                    <p>Master Student</p>
                    <p>Major in Information Science</p>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3">
                <p><strong>Yingjie Guo:</strong></p>
                <br>
                <a href="#demo2" data-toggle="collapse">
                    <img src="IMG_0884.JPG" class="img-circle" alt="Random Name" width="120" height="120">
                </a>
                <div id="demo2" class="collapse">
                    <p>Master Student</p>
                    <p>Major in Computer Science</p>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

@endsection