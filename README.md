## 
# 人脸识别on区块链
#
# <img src="https://raw.githubusercontent.com/lawup/nasface/master/demo0.JPG" width="880px"/>
# <img src="https://raw.githubusercontent.com/lawup/nasface/master/demo1.JPG" width="880px"/>
# 
## http://180.76.136.150/
## http://NasFace.com （域名备案中，请先使用上述IP地址访问）
## 
### 本作品提供一套完整的【人脸识别】解决方案，并使用【区块链】存储和查询人脸特征数据，可广泛应用于各种场景，如【人脸锁】。
### 本作品区块链方案采用[星云链Nebulas](https://nebulas.io/)，请在开始使用前安装好[WebExtensionWallet](https://github.com/ChengOrangeJu/WebExtensionWallet)并创建账户后刷新，再开始操作。否则一系列的前期操作结果最终将无法与区块链交互，以至体验不到本作品运用区块链的核心意义。 
### [开源代码&演示文档](https://github.com/lawup/nasface)
### [区块链合约](https://explorer.nebulas.io/#/tx/3fb368b822c91506c0a58593e08b5bf9922a84f72c7469c5e36053312e6bc7de)
## 
##
##  Step1 上传一张图片
### 选择一张图片，点击【确认上传 → 】
### 单张不超过2M 支持jpg、png格式文件 
## 
##  Step2 人脸提取并对齐
### 待上传的图片显示出来，点击【下一步 人脸提取并对齐 → 】
### 点击一次后请耐心等待，计算过程大约一分钟，期间请不要再次点击，直到右边出现结果
### 后台运行的【人脸检测&对齐&裁剪】等归一化能力由[FaceTools](https://github.com/RiweiChen/FaceTools)提供 
##
##  Step3 人脸特征点提取
### 待人脸提取并对齐的结果图片显示出来，点击【下一步 人脸特征点提取 → 】
### 点击后请耐心等待，计算过程大约10秒，期间请不要再次点击，直到右边出现结果
### 后台运行的【人脸68个特征点的提取】，能力由[dlib](http://dlib.net)提供
### 提取人脸的68个特征点之后，系统会据此计算7个自定义的特征比例（同一个人脸的不同照片，特征比例将是确定的，因此可作为同一认定的依据。当然在目前的演示中，为了较好的用户体验，仅用了2个特征点比例，这样做降低了识别门槛，但在实际运用中会降低安全性，也有可能造成误识别），据此7项特征比例数据整体生成一个哈希值（为保护隐私，不提倡明文。若在正式应用中，可用pyc文件代替py文件，即可最大限度保护用户隐私） 
##
##  Step4 在区块链上查询/记录
### 待上一步计算完成，可点击【下一步 在区块链上查询/记录 →】进入Step5
##
##  Step5-1 查询
### 点击【查询 看看Ta是谁】按钮，系统会查询区块链网络，将结果反馈：
### 若已有记录，则反馈【内容（一般是该脸的主人的姓名，如“张三”）】及【记录人（提交内容的区块链钱包账号）】
##  Step5-2 记录
### 若点击【查询 看看Ta是谁】按钮，系统中没有查到相应记录，则会反馈：系统尚无该人脸记录，可【添加】该人脸信息
### 那么，点击【添加】，可在得到的输入框中输入脸主人的名字，再点击【提交数据到区块链上】，可调起[WebExtensionWallet](https://github.com/ChengOrangeJu/WebExtensionWallet)（因此事前应将其装好并创建钱包账户，账户中需有少许NAS币，大约0.0001就够，如果没有可微信作者71520977索要），在弹出框中【Unlock】了钱包账户的前提下，依次点击【Confirm】和【Submit】即可，然后等待数秒，数据即成功提交到区块链上了。
### 之后，再点击【查询 看看Ta是谁】按钮时，系统就会查询到刚刚提交的人脸信息了。（如果这是一个【人脸锁】的应用的话，这一步相当于是注册，而【查询】可以认为是在验证人脸）
##
##
##  运行环境
### windows10 （[FaceTools](https://github.com/RiweiChen/FaceTools)需要在windows下运行）
### php5.4 （需要打开exec()，即在PHP.ini中去掉disable_functions行的exec项）
### python3.5.3
### dlib19.4.0 （可下载安装编译好的whl文件dlib-19.4.0-cp35-cp35m-win_amd64.whl ，避免繁琐编译，下载链接：https://pan.baidu.com/s/1KSCF2r_Lt71l2aOpKoS0HA 密码：qn54 ）
### dlib要用到的人脸库 shape_predictor_68_face_landmarks.dat 在[这里下载](http://dlib.net/files/shape_predictor_68_face_landmarks.dat.bz2) ，下载后放在本程序根目录中即可
### 
### 
### 需要说明的是，本作品仅是个实验作品，有关人脸识别的准确率和区块链的运行效率及可行性，尚在探讨中。
### 欢迎与作者联系，微信：71520977  
###

