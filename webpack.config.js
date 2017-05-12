var path = require('path');
var webpack = require('webpack');

var config = {
    bowerDir: './vendor/bower_components',
    npmDir: './node_modules'
};

module.exports = {
	//傳入一個檔案或者路徑字串 (別名：路徑)
	entry: {
		//共用
		'all': './resources/js/page/all.js',
		//前台
		'home': './resources/js/page/home.js',
		//後台
		'admin': './resources/js/page/admin.js',
		//個人資料
		'profile': './resources/js/page/profile.js',
		//測試用
		'test': './resources/js/page/test.js',
	},
	//輸出位置, laravel 預設讀取public之下目錄
	output: {
        path: path.join(__dirname, 'public/js/page'),
        filename: '[name].js',
    },
    module: {
    	//載入, 解析, 轉譯  可以留給laravel elixir 做
    	loaders: [
    		{
	            //test 值為正規化格式, 要轉譯的路徑, 檔名
	            test: /\.js?$/,
	            //exclude 排除文件
	            exclude: /(node_modules|bower_components)/,
	            //loader+options => babel?presets[]=ec2015
	            loader: 'babel-loader',
	            options: {
                	// 轉成es2015格式，支援舊的 Browser
                    presets: [ 'es2015' ]
                },
        	},
    		{
    			test:/\.css$/,
    			// style-loader!css-loader的縮寫 !是串連的意思
    			loader: 'style!css'
    		},
    		{
    			test: /\.(png|jpg)$/,
    			//可以寫成url?limit=1024
    			loader: 'url-loader',
    			query: {limit: 1024}
    		}
    	]
    },
    resolve: {
    	alias: {
    		'autosize': path.join(__dirname, config.bowerDir + '/autosize/dist/autosize.min.js'),
    		'bootstrap': path.join(__dirname, config.bowerDir + '/jasny-bootstrap/dist/js/jasny-bootstrap.min.js'),
            'bootstraptooltip': path.join(__dirname, config.bowerDir + '/jquery-validation-bootstrap-tooltip/jquery-validate.bootstrap-tooltip.min.js'),
            'jquery': path.join(__dirname, config.bowerDir + '/jquery/dist/jquery.min.js'),
    	    'layzr': path.join(__dirname, config.bowerDir + '/layzr.js/dist/layzr.min.js'),
            'lazyloadxt': path.join(__dirname, config.bowerDir + '/lazyloadxt/dist/jquery.lazyloadxt.min.js'),
            'lazyloadxt.bg': path.join(__dirname, config.bowerDir + '/lazyloadxt/dist/jquery.lazyloadxt.bg.js')
    	}
    },
    plugins: [
    	new webpack.ProvidePlugin({
    		'autosize': 'autosize',
    		'bootstrap': 'bootstrap',
    		'jQuery': 'jquery',
            '$': 'jquery',
            'window.jQuery': 'jquery',
            'Layzr': 'layzr'
    	})
    ]

};

//css 打包
module.exports = {
	//傳入一個檔案或者路徑字串 (別名：路徑)
	entry: {
		//共用
		'all': './resources/css/page/all.css',
		//前台
		'home': './resources/css/page/home.css',
		//後台
		'admin': './resources/css/page/admin.css',
		//個人資料
		'profile': './resources/css/page/profile.css',
		//測試用
		'test': './resources/css/page/test.css',
	},
	//輸出位置, laravel 預設讀取public之下目錄
	output: {
        path: path.join(__dirname, 'public/css/page'),
        filename: '[name].css',
    }
};