<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
  table, th, td {

  border: 1px solid black;
  border-collapse: collapse;
}
table{
  width:100%;
}
#name{

}
.sign{
  width: 40px;
}
</style>
</head>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
      <thead>
       <tr>
          <td>No.</td>
          <td id="name">Name</td>
          <td id="sex">Sex</td>
          <td class="sign"></td>
          <td class="sign"></td>
          <td class="sign"></td>
          <td class="sign"></td>
          <td class="sign"></td>
          <td class="sign"></td>
          <td class="sign"></td>
          <td class="sign"></td>
       </tr>
      </thead>
      @php
        $i=1;
      @endphp
      @foreach($student as $stu)
      <tr>
      
        <td>{{$i}}</td>
        <td>{{$stu->name}} {{$stu->fname}} {{$stu->lname}}</td>
        <td>{{$stu->sex}}</td>
        <td class="sign"></td>
        <td class="sign"></td>
        <td class="sign"></td>
        <td class="sign"></td>
        <td class="sign"></td>
        <td class="sign"></td>
        <td class="sign"></td>
        <td class="sign"></td>
        
      </tr>
      @php
      $i++;
    @endphp
      @endforeach
    </table>

  </body>
</html>
