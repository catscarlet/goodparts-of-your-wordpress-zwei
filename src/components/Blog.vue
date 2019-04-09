<template>
<div>

    <div class="drawer-list-on-desktop">
        <mu-drawer :open.sync="drawer" :docked="docked" :z-depth="depth">
            <mu-appbar style="width: 100%;" title="Select a title" color="#bccc9" text-color="#030f1f"></mu-appbar>
            <mu-list textline="three-line" v-loading="loading_list">
                <mu-list-item avatar button @click="show(item.ID)" v-for="(item, index) in list" :key="index">
                    <mu-list-item-content>
                        <mu-list-item-sub-title class="title-in-list">
                            {{ item.post_title }}
                        </mu-list-item-sub-title>
                    </mu-list-item-content>
                    <mu-list-item-action>
                        <mu-list-item-after-text>{{ index + 1 }}</mu-list-item-after-text>
                    </mu-list-item-action>
                </mu-list-item>
            </mu-list>
        </mu-drawer>

    </div>

    <div class="blog-body" v-bind:class="{'drawer-push': !is_mobile}" v-loading="loading_content">
        <div class="site-title">
            <mu-appbar color="#395c7d">

                <mu-button icon slot="left" @click="showDrawer" v-show="is_mobile">
                    <mu-icon value="menu"></mu-icon>
                </mu-button>

                {{ title }}

                <mu-menu slot="right">
                    <mu-button flat>MENU</mu-button>
                    <mu-list slot="content">
                        <mu-list-item button @click="openNewWindow('https://github.com/catscarlet/goodparts-of-your-wordpress-zwei')">
                            <mu-list-item-content>
                                <mu-list-item-title>GITHUB</mu-list-item-title>
                            </mu-list-item-content>
                        </mu-list-item>
                    </mu-list>
                </mu-menu>
            </mu-appbar>
        </div>

        <div v-if="content.title" class="content">
            <div class="title-zone">
                <span class="post-title">{{ content.title }}</span>
            </div>

            <div id="real-content" v-if="content.title" class="real-content" v-html="content.content"></div>

            <div v-if="content.link" class="title-zone">
                <hr>
                <em>Link:
                    <a :href="content.link" target="_blank">{{ content.link }}</a>
                </em>
            </div>
        </div>

        <div v-else class="blank">
            <div v-if="!is_mobile" v-html="description"></div>
            <div v-else v-html="description_mobile"></div>
        </div>
    </div>

</div>
</template>

<script>
import {
    isMobile
} from '../common/';

export default {
    data() {
        return {
            title: this.$siteconf.title,
            api: this.$siteconf.api,
            description: this.$siteconf.description,
            description_mobile: this.$siteconf.description_mobile,

            docked: true,
            drawer: false,
            drawer_position: 'left',
            depth: 1,
            is_mobile: null,

            content: {
                'title': '',
                'link': '',
                'content': '',
            },
            list: [],
            startX: null,
            startY: null,
            endX: null,
            endY: null,

            loading_list: true,
            loading_content: false,

            debug_info: '',
        };
    },
    beforeMount() {
        this.getlist();
    },
    mounted() {
        this.is_mobile = isMobile();
        this.handleResize = () => {
            this.is_mobile = isMobile();
        };
        window.addEventListener('resize', this.handleResize);
        window.addEventListener('touchstart', this.touchStart);
        window.addEventListener('touchmove', this.touchAndMove);
    },
    methods: {
        getlist: function(id, event) {
            var self = this;
            this.$axios.get(this.api + 'readlist.php')
                .then(function(response) {
                    self.list = response.data;
                    self.loading_list = false;
                })
                .catch(function(error) {
                    self.list = [{
                        'ID': 9999,
                        'post_date': '2019-04-01 12:34:56',
                        'post_title': 'GetList Failed',
                        'permalink': '',
                    },];
                    self.loading_list = false;
                });
        },
        showDrawer: function() {
            this.drawer = true;
        },
        show: function(id, event) {
            if (!id) {
                return;
            }

            if (this.is_mobile) {
                this.drawer = false;
            }

            var self = this;
            self.loading_content = true;
            this.$axios.get(this.api + '/get_content.php?id=' + id)
                .then(function(response) {
                    self.draw(id, response.data.content);
                })
                .catch(function(error) {
                    self.content.title = 'Get Content Failed.';
                    self.content.content = '';
                    self.content.link = '';
                    self.loading_content = false;
                });
        },
        draw: function(id, content) {
            function maxwidth(contentp) {
                var regexp1 = new RegExp(/(\<img[^>]*)(\>)/, 'g');
                contentp = contentp.replace(regexp1, function(match, p1, p2) {
                    return p1 + 'style="max-width: 100%; height: auto;"' + p2;
                });
                return contentp;
            }

            function nocaption(contentp) {
                var regexp1 = new RegExp(/\[caption .*\"\]/, 'g');
                var regexp2 = new RegExp(/(\<img.*\>)(.*)\[\/caption\]/, 'g');

                contentp = contentp.replace(regexp1, '<br>');
                contentp = contentp.replace(regexp2, function(match, p1, p2) {
                    return p1 + '<br>' + p2;
                });
                return contentp;
            }

            function preCode(contentp) {
                var regexp1 = new RegExp(/(\<pre[^>]*)(\>)/, 'g');

                contentp = contentp.replace(regexp1, function(match, p1, p2) {
                    return p1 + 'style="overflow: auto; background-color: #f6f8fa; padding: 16px; line-height: 1.45; border-radius: 3px; font-size: 85%;"' + p2;
                });
                return contentp;
            }

            var contentp;
            var self = this;

            this.list.forEach(function(v, i) {
                if (v.ID == id) {
                    self.content.title = v.post_title;
                    self.content.link = v.permalink;
                }
            });

            contentp = this.$autop(content);
            contentp = maxwidth(contentp);
            contentp = nocaption(contentp);
            contentp = preCode(contentp);

            window.scrollTo(0, 0);

            this.content.content = contentp;
            self.loading_content = false;
        },
        openNewWindow: function(url) {
            var win = window.open(url, '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Browser has blocked it
                alert('Please allow popups for this website');
            }
        },
        changeNav: function() {
            if (this.is_mobile) {
                this.docked = false;
                this.drawer = false;
                this.depth = 16;
            } else {
                this.docked = true;
                this.drawer = true;
                this.depth = 1;
            }
        },
        touchStart: function(event) {
            this.startX = event.changedTouches[0].pageX;
            this.startY = event.changedTouches[0].pageY;
        },
        touchAndMove: function(event) {
            let startX = this.startX;
            let startY = this.startY;
            let endX = event.changedTouches[0].pageX;
            let endY = event.changedTouches[0].pageY;

            let distanceX = endX - startX;
            let distanceY = endY - startY;
            this.debug_info = distanceX + '<br>' + distanceY;
            if (Math.abs(distanceX) > Math.abs(distanceY) && distanceX > 100) {
                this.drawer = true;
            } else if (Math.abs(distanceX) > Math.abs(distanceY) && distanceX < 100) {
                this.drawer = false;
            } else if (Math.abs(distanceX) < Math.abs(distanceY) && distanceY < 100) {
            } else if (Math.abs(distanceX) < Math.abs(distanceY) && distanceY > 100) {
            } else {
            }
        },
    },
    watch: {
        is_mobile: function(val, oldVal) {
            this.changeNav();
        },
    },
};
</script>

<style scoped>
body {
}

.blog-body {
}

.drawer-push {
    padding-left: 256px;
}

.site-title {
    position: fixed;
    width: 100%;
    height: 56px;
}

.title-zone {
    text-align: center;
    padding-top: 96px;
    padding-bottom: 40px;
    border-bottom: 1px solid grey;
}

.post-title {
    color: rgba(0, 0, 0, .8);
    letter-spacing: -.02em;
    font-size: 180%;
    font-weight: 400;
    margin: 0 !important;
    padding: 10px 12px;
    word-wrap: break-word;
}

.title-in-list {
    color: rgba(0, 0, 0, .7);
}

.content {
    max-width: 800px;
    margin: 0 auto;
    background-color: white;
}

.real-content {
    font-size: 100%;
    line-height: 165%;
    padding-bottom: 50px;
    padding-left: 20px;
    padding-right: 20px;
    overflow: hidden;
    word-wrap: break-word;
}

.blank {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    padding-top: 60vh;
    padding-bottom: 40px;
    font-size: large;
}
</style>
