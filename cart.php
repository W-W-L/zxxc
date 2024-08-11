<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>导航栏示例</title>
<link rel="stylesheet" href="frist.css">
<link rel="stylesheet" href="iconfont.css">
</head>
<body>
<div class="connatior">
      <!-- 导航栏 -->
    <div class="navbar">
      <!-- 左侧Logo和链接 -->
       <div class="navbar-con">
        <ul class="clearfix">
          <li><a href="#home" style="font-weight: bold; font-size: 1.5em;margin-right: 50px;">Logo</a> </li>
          <li><a href="#home">首页</a></li>
          <li><a href="#gallery">图库</a>
            <div>
              <a href="#">我的图册</a>
              <a href="#">我的项目</a>
              <a href="#">我的收藏</a>
            </div>
          </li>
          <li><a href="#resources">资源管理</a></li>
          <li><a href="#events">活动</a></li>
          <li><a href="#help">帮助</a></li>
        </ul>
       </div>
      <!-- <div>
        <a href="#home" style="font-weight: bold; font-size: 1.5em;margin-right: 50px;">Logo</a>
        <a href="#home">首页</a>
        <a href="#gallery">图库</a>
        <a href="#resources">资源管理</a>
        <a href="#events">活动</a>
        <a href="#help">帮助</a>
      </div> -->
      
      <!-- 右侧搜索、上传、购物车和用户图标 -->
      <div class="navbar-icons">
        <input type="text" placeholder="搜索...">
        <i class="iconfont icon-shangchuan1"></i>
        <i class="iconfont icon-yingwen"></i>
        <i class="iconfont icon-gouwuche1"></i>
        <i class="iconfont icon-tongzhi1"></i>
      </div>
    </div>
   <!-- 用户名列表 -->
    <div class="username-list">
      <!-- 用户名项 -->
      <div class="username-item">
        <img src="path-to-avatar.jpg" alt="Avatar" class="avatar">
        <div class="my-resources">
          <span class="username">用户名1</span>
          <ul class="resources">
            <li>我的资源</li>
            <li>我的收藏</li>
            <li>我的项目</li>
          </ul>
        </div>
      </div>
      <!-- 更多用户名项 -->
      <!-- ... -->
    </div>
    <div class="wrap">
      <div class="page-manage-left">
        <a href="#" class="option">图库</a>
        <a href="#" class="option">相册</a>
        <a href="#" class="option">其他添加自己做的内容</a>
      </div>
      <div class="page-manage-right">
		  <div>
				<button id="add"  onclick="history.back()" style="width:80px;height:30px; background:#FAFAD2;font-size:15px;position: relative;top:0px;left:250px; border-radius: 10px; cursor: pointer;text-decoration: none;  ">添加图片</button>
					<button id="delete" style="width:80px;height:30px; background:#FAFAD2;font-size:15px;position: relative;top:0px;left:250px; border-radius: 10px; cursor: pointer;text-decoration: none;  ">删除图片</button>
					<button id="uoload" style="width:80px;height:30px; background:#FAFAD2;font-size:15px;position: relative;top:0px;left:250px; border-radius: 10px; cursor: pointer;text-decoration: none;  ">下载图片</button>
					<button id="edit" style="width:80px;height:30px; background:#FAFAD2;font-size:15px;position: relative;top:0px;left:250px; border-radius: 10px; cursor: pointer;text-decoration: none;  ">编辑图片</button>
		  </div>
          <?php  
          // 数据库连接参数  
          $servername = "localhost";  
          $username = "root";  
          $password = "123456";  
          $dbname = "image";  
            
          // 创建连接  
          $conn = new mysqli($servername, $username, $password, $dbname);  
            
          // 检查连接  
          if ($conn->connect_error) {  
              die("连接失败: " . $conn->connect_error);  
          }  
            
          // 检查是否有图片ID传递过来  
          if (isset($_GET['imageId']) && is_array($_GET['imageId'])) {  
              // 获取图片ID数组  
              $imageIds = $_GET['imageId'];  
            
              // 清理和验证ID数组中的每个值（防止SQL注入等）  
              $cleanImageIds = array_map('intval', $imageIds);  
            
              // 查询数据库以获取图片信息  
              $query = "SELECT * FROM img WHERE id IN (" . implode(',', $cleanImageIds) . ")";  
              $result = $conn->query($query);  
            
             // 显示图片    
             if ($result->num_rows > 0) {    
                 echo '<div class="cart-images">';    
                 $imageId = 0; // 初始化图片ID  
                 while ($row = $result->fetch_assoc()) {    
                     $imageData = base64_encode($row["image"]);    
                     $imageId++; // 每次循环都递增ID  
                     echo '<div class="cart-image-container" id="image-container-' . $imageId . '" style=" margin-right: 10px; margin-bottom: 10px; background-color: transparent;">';    
                     echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="' . htmlspecialchars($row['i']) . '" style="display:inline-block;width: 620px; height: 670px; padding: 10px; margin-right: 10px;">';  
                     echo '</div>';    
                 }    
                 echo '</div>';    
                
             } else {    
                 echo '购物车中没有图片。';    
             }
          } else {  
              // 如果没有传递图片ID，显示错误或空购物车消息  
              echo '购物车为空或没有传递图片ID。';  
          }  
            
          // 关闭数据库连接  
          $conn->close();  
          ?>
      </div>
      
    </div>
</div>
  
<script>  
    // 获取所有具有类名 "back-button" 的按钮  
    var buttons = document.getElementsByClassName('add');  
      
    // 为每个按钮添加点击事件监听器  
    for (var i = 0; i < buttons.length; i++) {  
        buttons[i].addEventListener('click', function(e) {  
            e.preventDefault(); // 阻止按钮的默认行为（如果有的话）  
            history.back(); // 返回到上一个页面  
        });  
    }  
	
	 // 等待文档加载完成后执行  
	    document.addEventListener('DOMContentLoaded', function() {  
	        // 获取所有的图片容器  
	        var imageContainers = document.querySelectorAll('.cart-image-container');  
	  
	        // 遍历所有的图片容器  
	        imageContainers.forEach(function(container) {  
	            // 为每个图片容器添加点击事件监听器  
	            container.addEventListener('click', function() {  
	                // 改变点击的图片容器的背景颜色  
	                this.style.backgroundColor = 'lightblue'; // 
	               
	            });  
	        });  
	    });  
	
	
	document.addEventListener('DOMContentLoaded', function() {  
	    var deleteButton = document.getElementById('delete');  
	    var imageContainers = document.querySelectorAll('.cart-image-container');  
	  
	    // 假设我们有一个变量来跟踪当前选中的图片容器  
	    var selectedContainer = null;  
	  
	    // 为每个图片容器添加点击事件监听器  
	    imageContainers.forEach(function(container) {  
	        container.addEventListener('click', function() {  
	            // 清除其他容器的选中状态（如果需要的话）  
	            if (selectedContainer) {  
	                selectedContainer.classList.remove('selected');  
	            }  
	              
	            // 设置当前容器为选中状态  
	            this.classList.add('selected');  
	            selectedContainer = this;  
	        });  
	    });  
	  
	    // 为删除按钮添加点击事件监听器  
	    deleteButton.addEventListener('click', function() {  
	        // 检查是否有选中的图片容器  
	        if (selectedContainer) {  
	            // 移除选中的图片容器  
	            selectedContainer.parentNode.removeChild(selectedContainer);  
	            // 清除选中状态  
	            selectedContainer = null;  
	        } else {  
	            // 如果没有选中的图片容器，可以显示一个提示或什么都不做  
	            alert('请先选择一张图片！');  
	        }  
	    });  
	});
</script>
