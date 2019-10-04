(function() {
    tinymce.PluginManager.add( 'custom_text_block', function( editor, url ) {

        // Add Button to Visual Editor Toolbar
        editor.addButton('custom_text_block', {
            title: 'Вставить/отформатировать блок текста',
            cmd: 'custom_text_block',
            image: url + '/images/text.png',
            onClick: function () {
                var selection = editor.selection.getContent({format : 'text'});
                var selectionHtml = editor.selection.getContent({format : 'html'});

                if (selection != '') {
                    editor.execCommand('mceReplaceContent', false, '<div class="portfolio--unit__text">' + selectionHtml + '</div>');
                    alert('Добавлен класс portfolio--unit__text!');
                } else {
                    alert('Выделите текст!');
                }
            }
        });

        editor.addButton('screenshot_block', {
            title: 'Вставить скриншот по ширине',
            cmd: 'screenshot_block',
            image: url + '/images/screenshot.png',
            onClick: function () {

                metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
                    title: 'Загрузить скриншот по ширине',
                    button: { text:  'Загрузите скриншот по ширине' },
                });

                metaImageFrame.on('select', function() {
                    var media_attachment = metaImageFrame.state().get('selection').first().toJSON();
                    editor.execCommand('mceReplaceContent', false, '<div class="portfolio--unit__browser--width"><img src="'+media_attachment.link+'"></div>');
                });

                metaImageFrame.open();
            }
        });

        editor.addButton('screenshot_block_height', {
            title: 'Вставить скриншот по высоте',
            cmd: 'screenshot_block_height',
            image: url + '/images/screenshot.png',
            onClick: function () {

                metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
                    title: 'Загрузить скриншот по высоте',
                    button: { text:  'Загрузите скриншот по высоте' },
                });

                metaImageFrame.on('select', function() {
                    var media_attachment = metaImageFrame.state().get('selection').first().toJSON();
                    editor.execCommand('mceReplaceContent', false, '<div class="portfolio--unit__browser--height"><img src="'+media_attachment.link+'"></div>');
                });

                metaImageFrame.open();
            }
        });
    });
})();