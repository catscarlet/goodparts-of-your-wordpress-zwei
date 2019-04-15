# The Good Parts of Your WordPress Zwei

## 简介

这个项目是用来展示你博客中精选出来的文章用的。项目名取自 O’Reilly 的梗，The Good Parts，以及德语 Zwei。

文章内容是从 **你自己的 Wordpress** 中读取的，所以要使用这个项目，你需要有权限读取自己的 WordPress 数据库。

这个项目的目的是制作另一个展示页，用来展示你博客中一部分内容的用的。像我这种吃喝游玩还是技术教程什么都写博客的，在一定场合下，博客内容展示就会非常尴尬。这时候如果有一个独立的展示页面，只展示特定的文章，就可以避免这种尴尬了。

这是实现这个场景功能的第二个项目了，这个项目较前一个项目，增加了一些特性，比如移动端的展示，以及 Lazyload 。

上一个项目：[goodparts-of-your-wordpress (Archived)](https://github.com/catscarlet/goodparts-of-your-wordpress)

## Demo

[https://articles.catscarlet.com/ (Simplified Chinese)](https://articles.catscarlet.com/)

## 3rd-party-libs

- vue
- @vue/cli
- muse-ui
- muse-ui-loading
- axios
- wordpress-autop
- vue-lazyload

## Requirements & Build & Usage

### Server

- WordPress(HTTP Service + PHP + MySQL), 需要访问你 WordPress MySQL 数据库的权限。

### 准备

所有 **API** 文件存放于 `api/` 目录下，请拷贝至服务器上，并编辑 `main.js` 文件中的 `Vue.prototype.$siteconf`

#### 准备 API

编辑 `api/config.php`, 编辑 `$allowed_referers` 放开域名请求权限(http_referer), 以及 `$mysqli` 以访问 WordPress MySQL.

执行 `generate_list.php` （命令行或浏览器均可），会输出一个 json 列表，将内容复制到 `api\list.json`。只复制你想要展示的标题即可。

现在可以重命名或删除 `generate_list.php` 文件，保证安全。

### 编译准备

修改 `public/index.html` 中的 title。

修改 `components/Welcome.vue` 组件。你可以完全自定义你的 Welcome 界面。

### Serve & build

yarn.lock, so

- yarn run serve
- yarn run build

## 已知问题

- 不支持任何一个版本的 IE 。尝试使用 IE 进行访问会弹窗提示。
- 部分 iOS 11 用户无法正常访问。我没有任何 iOS 设备或 Mac 设备。如果你有任何相关的信息，请提交至 Issue。
- API 跨域请求部分代码未完成。

## 开发日志

[新开源项目：The Good Parts of Your WordPress Zwei](https://blog.catscarlet.com/201904123352.html)

## License

MIT
