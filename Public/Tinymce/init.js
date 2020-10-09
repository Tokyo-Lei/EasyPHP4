// 这个是配置文件
tinymce.init({
    selector: '#mytextarea',
    content_css: 'Public/Tinymce/style.css', // 编辑内容区附加css文件
    language_url: 'Public/Tinymce/langs/zh_CN.js', // 本地化中文语言包
    language: 'zh_CN', // 默认语言简体中文
    menubar: false, // 隐藏菜单栏，显示请设置为true
    statusbar: true, // 隐藏状态栏，显示请设置为true
    resize: true, // 仅允许改变高度
    toolbar_mode: 'floating', // 工具栏抽屉模式 取值：floating / sliding / wrap
    toolbar_sticky: true, // 停靠工具栏到顶部
    branding: false, // 隐藏标示，防止误点
    min_height: 500, // 最小高度
    draggable_modal: true, // 模态框允许拖动（主要针对后续插件应用）
    image_uploadtab: false, // 不展示默认的上传标签，用xiunoimgup就可以，支持多文件/单文件上传。
    plugins: ['advlist', 'anchor', 'autolink', 'autoresize', 'charmap', 'code', 'codesample', '-directionality', 'fullscreen', 'help', 'hr', 'image', '-insertdatetime', 'link', 'lists', 'media', 'paste', 'preview', 'quickbars', 'table', 'textpattern', 'toc', '-visualblocks', '-visualchars', 'xiunoimgup', 'wordcount'], // 加载的插件，-为禁用
    toolbar: ['fontformats code | undo redo | styleselect | formatting fontcolor removeformat | alignment blockquote indentation list | imgup link media codesample table | anchor hr toc preview | other | fullscreen | customInsertButton | customInser2tButton', t_external_toolbar.join(' ')], // 界面按钮
    toolbar_groups: { //按钮分组，节省空间，方便使用
        formatting: {
            icon: 'format',
            tooltip: '格式化',
            items: 'formatselect | fontselect | fontsizeselect | bold italic underline strikethrough | superscript subscript'
        },
        alignment: {
            icon: 'align-left',
            tooltip: '对齐',
            items: 'alignleft aligncenter alignright alignjustify'
        },
        imgup: {
            icon: 'gallery',
            tooltip: '上传图片',
            items: 'xiunoimgup | image'
        },
        list: {
            icon: 'unordered-list',
            tooltip: '列表',
            items: 'bullist numlist'
        },
        indentation: {
            icon: 'indent',
            tooltip: '缩进',
            items: 'indent outdent'
        },
        fontcolor: {
            icon: 'color-levels',
            tooltip: '文字颜色',
            items: 'forecolor backcolor'
        },
        other: {
            icon: 'more-drawer',
            tooltip: '更多按钮',
            items: 'charmap -insertdatetime help'
        }
    },
    // skin: 'oxide-dark',  // 设置深色皮肤，默认为oxide
    // cache_suffix: '?v=1.0.3',// 缓存css/js url自动添加后缀
    fontsize_formats: '12px 14px 16px 18px 24px 36px 48px 56px 72px',
    font_formats: '微软雅黑=Microsoft YaHei,Helvetica Neue,PingFang SC,sans-serif;苹果苹方=PingFang SC,Microsoft YaHei,sans-serif;宋体=simsun,serif;仿宋体=FangSong,serif;黑体=SimHei,sans-serif;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats;知乎配置=BlinkMacSystemFont, Helvetica Neue, PingFang SC, Microsoft YaHei, Source Han Sans SC, Noto Sans CJK SC, WenQuanYi Micro Hei, sans-serif;小米配置=Helvetica Neue,Helvetica,Arial,Microsoft Yahei,Hiragino Sans GB,Heiti SC,WenQuanYi Micro Hei,sans-serif',
    paste_data_images: true, // 粘贴图片必须开启
    indentation: '2em', // padding方式的缩进，没text-indent好用，但这个不需要插件
    quickbars_selection_toolbar: 'bold italic | link | H1 H2 H3 | blockquote', // pc端可禁用快速工具栏填写false
    quickbars_insert_toolbar: false, // pc端禁用回车工具栏
    media_live_embeds: true, // 让媒体编辑时可观看（但实际测试中无用）
    contextmenu: false, // 禁用编辑器的右键菜单@c
    external_plugins: t_external_plugins, // 附加插件
    images_upload_handler: function(blobInfo, success, failure) {
        // 此方法来自xiuno.js，图片粘贴上传使用
        xn.upload_file(blobInfo.blob(), xn.url('attach-create'), {
            is_image: 1
        }, function(code, json) {
            if (code == 0) {
                success(json.url);
            } else {
                $.alert(json);
            }
        });
    },
   
});