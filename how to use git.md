git常用基本命令总结

ssh的配置
ssh-keygen -t rsa -C "godloveevin@yeah.net"
公钥文件默认保存的路径：c:\User\Administrator\.ssh，打开id_rsa.pub文件，
拷贝到github的ssh配置中，github上title任意取值，比如，wenhuayi；

配置提交者的账号和名称
git config --global user.email "github的邮箱" #godloveevin@yeah.net
eg：git config --global user.email "godloveevin@yeah.net"
git config --global user.name "github的用户名"  #godloveevin
eg: git config --global user.name "godloveevin"

建立工作目录
mkdir ~dev; cd dev; git clone 你自己的github项目git地址；
git clone https://github.com/godloveevin/php-points.git（克隆）

基本操作
git status  #查看文件的状态
git diff    #查看对比文件修改前和修改后的变化
git add 文件名 #添加文件
git add 目录名/* #批量添加，目录可以使新建的
git rm 文件名 #删除文件
git rm -r 目录名/ #删除指定目录以及目录下的所有文件和子目录
git commit -m "提交注释" #提交
git push -u origin master #提交到远程，提示输入用户名godloveevin和密码*******

解决向github提交代码不用总是输入用户名以及密码
git config --global credential.helper store #修改git配置
这一步，会在用户目录下的.gitconfig文件最后加上
[credential]
 helper = store
当配好之后的首次push代码时，需要输入账号密码，之后push就不用输入账号密码了

分支相关命令
1）查看分支
git branch //查看本地分支
git branch -r //查看远程分支
git branch -a //查看所有分支，包括本地和远程的分支
2）切换分支
git checkout dev //切换到dev分支上
3）创建分支
git checkout dev //在当前分支上创建dev分支
git checkout -b dev //在当前的分支上新创建的dev分支并切换到新的创建的dev分支上
git push origin dev // 创建远程dev分支，本地dev分支必须存在
4）查看分支是从哪个分支上创建的
git reflog --date=local --all | grep dev //查看在dev分支上的操作
git reflog show --date=iso dev
5）删除分支
git branch -d dev //删除本地dev分支
git push origin --delete dev //删除远程dev分支
6）分支的合并merge
git merge dev //将dev分支合并到当前分支（一般是master主分支）
git push //将当前分支代码push到远程分支上
7)查看commit记录
git log --graph//#查看历史提交记录

查看当前分支最后一条commit记录信息
git show-branch #查看当前分支最后一条commit记录信息

同步远程分支代码到本地的命令
方法一: git pull
git pull origin master//获取下来直接自动合并，不安全
方法二: git fetch
git fetch orgin master//单独拉取远程分支代码
git log -p master..origin/master//比较差异
git meger origin/master//进行合并
注意：直接在某个分支下使用git push会有如下提示
执行一下：git push --set-upstream origin dev
提示没有设置远程的push分支

git冲突以及解决方案
团队中两人同时fetch了同一个分支，第一个人修改后提交，第二个人提交就失败。
注意点：每次push之前，先pull或者fetch一下，保证您的分支代码始终是最新的。

解决方案：
1、获取远程分支更新，也就是第一个人提交的
git fetch origin dev
2、尝试由git带来的自动合并
git merge origin/master ##将origin/master合并到当前分支
如果两个分支的内容有差异，则提示合并失败
3、查看当前的状态，寻找帮助信息：
git status
4、手动合并
git mergetool 文件名