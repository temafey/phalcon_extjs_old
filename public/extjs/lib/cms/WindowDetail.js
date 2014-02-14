Ext.define('Cms.WindowDetail', {

    extend: 'Ext.panel.Panel',
    alias: 'widget.cmsWindowDetail',

    border: false,

    initComponent: function(){
        var me = this;
        me.display = Ext.create('Cms.WindowPost', {});
        me.controllerApp = Ext.create(me.controller, {});
        me.controllerApp.init();

        Ext.apply(me, {
            layout: 'border',
            items: [me.createGrid(), me.createSouth(), me.createEast()]
        });
        me.relayEvents(me.display, ['opentab']);
        me.relayEvents(me.grid, ['rowdblclick']);
        me.callParent(arguments);
    },

    /**
     * Loads a grid.
     * @param {String} controller
     */
    loadWindow: function(controller){
        var me = this;
        me.grid.loadWindow(controller);
    },

    /**
     * Creates the grid
     * @private
     * @return {Event.view.*.Grid} grid
     */
    createGrid: function(){
        var me = this;
        me.grid = Ext.create(me.controllerApp.grid, {
            region: 'center',
            dockedItems: [me.createTopToolbar()],
            flex: 2,
            minHeight: 200,
            minWidth: 150,
            listeners: {
                scope: me,
                select: me.onSelect
            }
        });
        me.grid.reconfigure(me.controllerApp.activeStore);
        me.grid.store.autoSync = true;
        me.grid.display = me.display;
        me.grid.window = me;
        //me.loadWindow(me.url);
        return me.grid;
    },

    /**
     * Creates the form
     * @private
     * @return {Event.view.*.Form} grid
     */
    createForm: function(){
        var me = this;
        //if (me.form !== undefined) {
            me.form = Ext.create(me.controllerApp.form, {
                region: 'center',
                grid: me.grid,
                listeners: {
                    scope: me//,
                    //select: me.onSelect
                }
            });
        //}

        return me.form;
    },

    /**
     * Creates the window
     * @private
     * @return {Event.view.*.Grid} grid
     */
    createWindow: function(title){
        var me = this;
        me.win = Ext.create('widget.window', {
            title: title,
            closable: true,
            closeAction: 'hide',
            maximizable: true,
            width: 600,
            minWidth: 350,
            height: 350,
            layout: 'border',
            bodyStyle: 'padding: 5px;'
        });

        return me.win;
    },

    /**
     * Fires when a grid row is selected
     * @private
     * @param {Event.view.*.Grid} grid
     * @param {Ext.data.Model} rec
     */
    onSelect: function(grid, rec) {
        var me = this;
        me.display.setActive(me, rec);
    },

    /**
     * Creates top controller toolbar.
     * @private
     * @return {Ext.toolbar.Toolbar} toolbar
     */
    createTopToolbar: function(){
        var me = this;
        me.toolbar = Ext.create('widget.toolbar', {
            cls: 'x-docked-noborder-top',
            items: [
                /*{
                    iconCls: 'open-all',
                    text: 'Open All',
                    scope: this,
                    handler: me.onOpenAllClick
                },
                '-',*/
                {
                    xtype: 'cycle',
                    text: 'Reading Panel',
                    prependText: 'Preview: ',
                    showText: true,
                    scope: me,
                    changeHandler: me.readingPaneChange,
                    menu: {
                        id: 'reading-menu',
                        items: [{
                            text: 'Bottom',
                            checked: true,
                            iconCls:'preview-bottom'
                        }, {
                            text: 'Right',
                            iconCls:'preview-right'
                        }, {
                            text: 'Hide',
                            iconCls:'preview-hide'
                        }]
                }
            }]
        });
        return me.toolbar;
    },

    /**
     * Reacts to the open all being clicked
     * @private
     */
    onOpenAllClick: function(){
        var me = this;
        me.fireEvent('openall', this);
    },

    /**
     * Gets a list of titles/urls for each grid item.
     * @return {Array} The grid details
     */
    getWindowData: function(){
        var me = this;
        return me.grid.store.getRange();
    },

    /**
     * @private
     * @param {Ext.button.Button} btn The button
     * @param {Boolean} pressed Whether the button is pressed
     */
    onSummaryToggle: function(btn, pressed) {
        var me = this;
        me.grid.getComponent('view').getPlugin('preview').toggleExpanded(pressed);
    },

    /**
     * Handle the checked item being changed
     * @private
     * @param {Ext.menu.CheckItem} activeItem The checked item
     */
    readingPaneChange: function(cycle, activeItem){
        var me = this;
        switch (activeItem.text) {
            case 'Bottom':
                me.east.hide();
                me.south.show();
                me.south.add(me.display);
                break;
            case 'Right':
                me.south.hide();
                me.east.show();
                me.east.add(me.display);
                break;
            default:
                me.south.hide();
                me.east.hide();
                break;
        }
    },

    /**
     * Create the south region container
     * @private
     * @return {Ext.panel.Panel} south
     */
    createSouth: function(){
        var me = this;
        me.south =  Ext.create('Ext.panel.Panel', {
            layout: 'fit',
            region: 'south',
            border: false,
            split: true,
            flex: 2,
            minHeight: 150,
            items: me.display
        });
        return me.south;
    },

    /**
     * Create the east region container
     * @private
     * @return {Ext.panel.Panel} east
     */
    createEast: function(){
        var me = this;
        me.east =  Ext.create('Ext.panel.Panel', {
            layout: 'fit',
            region: 'east',
            flex: 1,
            split: true,
            hidden: true,
            minWidth: 150,
            border: false
        });
        return me.east;
    }
});
