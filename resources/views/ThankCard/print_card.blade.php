<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>ThankCard Score By Department Relation</title>  
 <style type="text/css">
   .left{
      float: left;
   }
  .text_content{
      background: #ffedba;
      margin-top:30px;
      padding:30px;
      padding-left: 60px;
      height: 410px;
      border:1px groove #DF4C2D;
      clear:both;
  }
  .text_content input[type=text]{
      background: transparent;
      border: 1px dotted #de3612;
  }
  .text_content p{
      color:#e83812;
  }
  .text_content .send_date{
      float: right;
  }
  .text_content .to_text{
      font-size: 18px;
   }
  .text_content .line_text{
      margin-top:15%; 
   }
  .text_content .line_text .left_content{
      width: 50%;
      float: left;
  }
  .text_content .line_text .right_content{   
     width: 50%;
     float: left;  
     position: absolute;
  }
  .text_content .line_text .right_content div{ 
      border-bottom: 1px solid #de3612;
      margin-bottom: 20px;
  } 
 </style>
 
</head>
<body> 
    <div class="row img_content"> 
        <img src="data:image/png;base64,<?php echo $image;?>" alt="BTS" style="width: 100%">
    </div>
    <div class= "text_content" > 
        <p class="send_date"><i>Date:{{$send_date}}</i></p>
        <p class="to_text">
            <strong><i>Dear {{$to}}</i></strong>
        </p> 
        <p> <strong>{{$title}}</strong></p> 
        <p>{{$send_text}} </p>
        
        <div class="line_text">
            <div class="left_content"> 
            </div>
            <div class="right_content">
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            </div>
        </div> 
     </div>  
</body>
</html>