/**
 * 封装ajax
 */
(function(){
    // 根据id获取节点dom对象
    var $ = function(id){
        return document.getElementById(id);
    };

    // 解决兼容性问题
    $.init = function(){
        try{
            var xhr = new XMLHttpRequest();
        }catch(e){
            var xhr = new ActiveXObject();
        }
      return xhr;
    };

    /**
     * 封装ajax的get请求方法
     * @param url 请求服务器的地址
     * @param callback 回调函数
     * @param datatype 数据传输格式 json，xml
     */
    $.get = function(url,callback,datatype=''){
        var xhr = $.init();
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
                if(datatype.toLowerCase() === 'json'){
                    callback(JSON.parse(xhr.responseText));
                }else if(datatype.toLowerCase() === 'xml'){
                    callback(xhr.responseXML);
                }else{
                    callback(xhr.responseText);
                }
            }
        };
        xhr.open('get',url);
        xhr.send();
    };

    /**
     * 封装ajax的post请求方法
     * @param url 请求服务器的地址
     * @param callback 回调函数
     * @param data post表单数据
     * @param datatype 数据传输格式 json，xml
     */
    $.post = function(url,callback,data,datatype=''){
        var xhr = $.init();
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
                if(datatype.toLowerCase() == 'json'){
                    callback(JSON.parse(xhr.responseText));
                }else if(datatype.toLowerCase() == 'xml'){
                    callback(xhr.responseXML);
                }else{
                    callback(xhr.responseText);
                }
            }
        };

        xhr.open('post',url);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhr.send(data);
    };

    window.$ = $;
})();