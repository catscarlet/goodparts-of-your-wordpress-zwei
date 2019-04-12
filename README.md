# The Good Parts of Your WordPress Zwei

[简体中文 README](README_zh-cmn-Hans.md)

## Introduction

This project is for you to show specified posts of your WordPress. The name is a meme of O’Reilly: The Good Parts, and German, Zwei as Two in English.

The posts are read from your own WordPress, so the access of MySQL of your WordPress is needed.

The purpose of the project is for showing specified posts of your WordPress in some complicated situations. One like me, posts almost everything like 'eating, gaming, developing' in WordPress, that makes awkward in some special situations, such as job-hunting. With this project, you can create a standalone page to show specified posts of your WordPress to avoid the embarrassing situations.

This is the second project of this case. Compared with the previous, this new project includes some new features, like Responsive web design and Lazyload.

Last project: [goodparts-of-your-wordpress<Archived>](https://github.com/catscarlet/goodparts-of-your-wordpress)

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

- WordPress(HTTP Service + PHP + MySQL), the access of MySQL of WordPress is needed.

### Prepare

All the **API** files are in the `api/` directory, please copy all of them on your server, and edit `Vue.prototype.$siteconf` in file `main.js`.

#### Prepare API

Edit `api/config.php`, edit `$allowed_referers` to allow your domain to request(http_referer), and `$mysqli` to access WordPress.

Then run(use cli, or browser) `generate_list.php` to generate a json list. Copy the output to `api\list.json`. Only copy the parts of which you want to show.

You can rename or remove the `generate_list.php` in case of security now.

### Build Requirements

- Node

### Serve & build

yarn.lock, so

- yarn run serve
- yarn run build

## Known Issues

- Doesn't support any version of IE, and there is not a notice.
- Some says iOS 11 have trouble. I don't have any iOS devices, nor any Mac devices. If anyone has trouble about it, please report it on the Issue.
- API CORS code not finished.

## Developing Blog

[Blog: New Project - The Good Parts of Your WordPress Zwei (Simplified Chinese)](https://blog.catscarlet.com/201904123352.html)

## License

MIT
