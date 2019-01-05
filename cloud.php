<?php
  require './lib/sidUnified.php';
  $SID = new SID("cloudyourself");
  $SID->loginCheck('./');

  // Select Profile Image
  $profileImg = $SID->profileGet($_SESSION['pid'], '.');
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/Cloud.css">
    <title>Cloud Yourself</title>
    <script type="text/javascript">
      var root = '/';
    </script>
  </head>
  <body>
    <div class="bar">
      <h1>
        <a class="Cloud Yourself" href="Cloud.html">
          <span class="blind">Cloud Yourself</span>
        </a>
      </h1>
      <li id = "gnb-my-layer"  class="gnb-my-li, profile" style="display: inline-block;">
        <div id = "gnb-my-namebox" class = "gnb-my-namebox">
          <a class="gnb-my" href="javascript:;" onclick="gnbUserLayer.click.Toggle(); return false">
            <img id="gnb-profile-img" src="<?=$profileImg?>" alt="내 프로필 이미지" style="display: line-block;" width="25" height="25">
            <span id="gnb-profile-filter-mask" class="filter-mask" style="display: inline-block;"></span>
            <span id ="gnb-name1" class="gnb-name" style="font-size: 15spx; color: white"><?=$_SESSION['nickname']?></span>
            <em class="blind" style="display: none;">내정보 보기</em>
          </a>
        </div>
      </li>
    </div>
    <!-- <div id="gnb-my-lyr" class="gnb-my-lyr">
      <div class="gnb-my-cont">
        <div class="gnb-my-area">
          <span class="gnb-mask"></span>
          <img src="https://ssl.pstatic.net/static/common/myarea/myInfo.gif" alt="프로필 이미지" width="50" height="50">
        </div>
        <div class="gnb-text-area">
          <div>
            <p class="gnb-cont">
              <span>asdfasdf</span>
            </p>
            <a id="gnb-text-logout"class="gnb-log-button">
              <span class="gnb-logout-text">로그아웃</span>
            </a>
          </div>
        </div>
      </div>
    </div> -->
    <div class="barPlaceholder"></div>
    <div class="container">
      <div class="nav whiteBack">
        <!-- 화면 작아졌을때 버튼 나오도록 추가할 것(onedrive.live.com 참고) -->
        <div class="dropdown">
          <p onclick="myFunction()" class="dropbtn" style="font-size: 25px;">사진</p>
          <div id="myDropdown" class="dropdown-content">
            <a href="#" style="font-size: 15px;">모든사진</a>
            <a href="#" style="font-size: 15px;">폴더</a>
          </div>
          <p class="dropbtn" style="font-size: 25px;">문서</p>
        </div>
      </div>
      <div class="optionSelector whiteBack">
        <input type="checkbox" id="allCheckbox" name="chk_info" value="All check" style="width:15px; height:15px;">
        <input type="button" id="uploadBtn" name="올리기" value="올리기" style="width: 63; height: 30;">
        <input type="button" id="downloadBtn" name="내리기" value="내려받기"style="width: 79; height: 30;">
        <input type="button" id="deleteBtn" name="삭제" value="삭제" style="width: 63; height: 30">
      </div>
      <div class="file">
        <div class="filename">
          <p>파일<span class="root"></span></p>

        </div>
        <div class="filelist">
          <div class="fileSelector" id="file0" onclick="fileSelect('file0')">
            <img src="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-react-assets/foldericons/folder-large_frontplate_thumbnail.svg">
            <br>
            <p class="fileName">폴더</p>
          </div>
          <div class="fileSelector" id="file1" onclick="fileSelect('file1')">
            <img src="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-react-assets/foldericons/folder-large_frontplate_thumbnail.svg">
            <br>
            <p class="fileName">폴더</p>
          </div>
          <div class="fileSelector" id="file2" onclick="fileSelect('file2')">
            <img src="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-react-assets/foldericons/folder-large_frontplate_thumbnail.svg">
            <br>
            <p class="fileName">폴더</p>
          </div>
          <div class="fileSelector" id="file3" onclick="fileSelect('file3')">
            <img src="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-react-assets/foldericons/folder-large_frontplate_thumbnail.svg">
            <br>
            <p class="fileName">폴더</p>
          </div>
          <div class="fileSelector" id="file4" onclick="fileSelect('file4')">
            <img src="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-react-assets/foldericons/folder-large_frontplate_thumbnail.svg">
            <br>
            <p class="fileName">폴더</p>
          </div>
        </div>
      </div>
      <div class="popup">
        <div class="deletePopup">
            <div style="position: relative;">
                <span class="Xbutton">X </span>
            </div>
        </div>
    </div>
    </div>
    <script>
      window.onload = function () {
        listSetter(root)
      }

      var listSetter = function (dir) {
        document.getElementsByClassName("root")[0].innerHTML = '/'+dir;
        $.ajax({
          url: './function/getFileList.php',
          type: 'POST',
          dataType: 'json',
          data: {folderName: dir},
          success: function (data) {

          }
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
      }

      var pictureDropdownStatement;
      /* When the user clicks on the button,
      toggle between hiding and showing the dropdown content */
      function myFunction() {
        var dd = document.getElementById("myDropdown")
        if (pictureDropdownStatement != "open") {
          dd.classList.toggle("show")
          dd.style.animationName = "dropdownOpen"
          dd.style.animationDuration = "1s"
          pictureDropdownStatement = "open";
        } else {
          dropdownClose(dd)
          pictureDropdownStatement = "close";
        }
      }

      // Close the dropdown menu if the user clicks outside of it
      window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
              dropdownClose(openDropdown)
              pictureDropdownStatement = "close";
            }
          }
        }
      }

      var dropdownClose = function(openDropdown) {
        openDropdown.style.animationName = ""
        openDropdown.style.animationDuration = ""
        setTimeout(() => {
          openDropdown.style.animationName = "dropdownOpen"
          openDropdown.style.animationDuration = "1s"
          openDropdown.style.animationDirection = "reverse"

          setTimeout(() => {
            openDropdown.classList.remove('show');
            openDropdown.style.animationName = ""
            openDropdown.style.animationDuration = ""
            openDropdown.style.animationDirection = ""
          }, 1000);
        }, 10);
      }

      var fileSelect = function(fileName) {
        document.getElementById(fileName).classList.toggle("selectedFile");
      }
    </script>
    <script src="./lib/jquery-3.3.1.min.js"></script>
  </body>
</html>
