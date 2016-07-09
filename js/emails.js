var request = require("request");

request.get("https://my.mlh.io/api/v1/users?client_id=189235eae180715ccf83c229798df38d3b9dc64f482e584522c238c641862f9e&secret=eb4efdaf40f345a59cea8c9d145be878c70bd19f361f5d68ba358640bebb0636",function(err,body,res){
    var parsed = JSON.parse(body).data;

    for(i=0;i<parsed.length;i++){
        var user = parsed[i];

        console.log(user.email);
    }
});