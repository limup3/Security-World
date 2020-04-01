<script
 src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 ​
 <script type="text/javascript">
 $(document).ready(function() {
 ​
 $.ajax({
 type : "GET",
 dataType : "JSON",
 url : "https://www.googleapis.com/youtube/v3/playlistItems?playlistId=https://www.youtube.com/channel/UCQIEU_pBV2wkn-gHg7RPvdQ&part=snippet&maxResults=8&key=AIzaSyASyU1D8PKZZQyhBrhb1dvqqx0i_0utoww",
 contentType : "application/json",
 success : function(jsonData) {
 for (var i = 0; i < jsonData.items.length; i++) {
     var items = jsonData.items[i];
     console.log("title : "+items.snippet.title);
     console.log("videoId : "+"https://youtu.be/"+items.snippet.resourceId.videoId);
     console.log("썸네일 : "+items.snippet.thumbnails.high.url);
 }
 },
 complete : function(data) {
 },
 error : function(xhr, status, error) {
 console.log("유튜브 요청 에러: "+error);
 }
 });
 });
 </script>
