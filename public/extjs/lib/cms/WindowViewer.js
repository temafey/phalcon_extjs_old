Ext.define('Cms.WindowViewer', {
    extend: 'Ext.container.Viewport',

    initComponent: function(){
        var me = this;
        Ext.define('Window', {
            extend: 'Ext.data.Model',
            fields: ['title', 'controller']
        });

        Ext.define('WindowItem', {
            extend: 'Ext.data.Model',
            fields: ['title', 'author', {
                name: 'pubDate',
                type: 'date'
            }, 'link', 'description', 'content']
        });

        Ext.apply(me, {
            layout: {
                type: 'border',
                padding: 5
            },
            items: [me.createMenuPanel(), me.createWindowInfo()]
        });
        me.callParent(arguments);
    },

    /**
     * Create the list of fields to be shown on the left
     * @private
     * @return {Cms.MenuPanel} MenuPanel
     */
    createMenuPanel: function(){
        var me = this;
        me.MenuPanel = Ext.create('Cms.MenuPanel', {
            region: 'west',
            collapsible: true,
            width: 225,
            //floatable: false,
            split: true,
            minWidth: 175,
            listeners: {
                scope: me,
                windowSelect: me.onWindowSelect
            }
        });
        return me.MenuPanel;
    },

    /**
     * Create the Window info container
     * @private
     * @return {Cms.WindowInfo} WindowInfo
     */
    createWindowInfo: function(){
        var me = this;
        me.WindowInfo = Ext.create('Cms.WindowInfo', {
            region: 'center',
            minWidth: 300
        });
        return me.WindowInfo;
    },

    /**
     * Reacts to a Window being selected
     * @private
     */
    onWindowSelect: function(window, title, controller){
        var me = this;
        me.WindowInfo.openTab(title, controller);
    }
});