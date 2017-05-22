
# About This

- `git clone git@github.com:gm8300130/laravel-studentsERD.git`

- [install Docker for Mac](https://docs.docker.com/docker-for-mac/install/)

- docker-compose up -d

- 建立.env, copy .env_example

- cli 輸入以下指令
    ``` 
    $ composer update
    
    $ yarn install 
    
    $ bower install 
    
    $ gulp
    ```
- 添加localhost 
`sudo vim /etc/hosts 加入 127.0.0.1:10080 localhost`

- Url : http://localhost:10080/
view :
![](http://ww4.sinaimg.cn/large/006tNbRwgy1ffqvw234hej315t0idq4n.jpg)

- workspace
本機沒安裝npm,brower,`php artisan` 之類, 可以進workspace 輸入指令
![](http://ww4.sinaimg.cn/large/006tNbRwgy1ffqvxlnnnaj30uk0la42h.jpg)
可改用 `bash`

- DB建立
新建資料庫 `studenterd`
    ```
    $ php artisan migrate
    $ php artisan db:seed
    ```
## Test
[Test PR info](https://github.com/gm8300130/laravel-studentsERD/pull/5)

```
$ phpunit tests/Student/testStudentGetApi.php
$ phpunit tests/Student/testStudentGradesApi.php
```


