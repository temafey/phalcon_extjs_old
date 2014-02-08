Ext.define('Cms.WindowDetail', {

    extend: 'Ext.panel.Panel',
    alias: 'widget.cmsWindowDetail',

    border: false,

    initComponent: function(){
        this.display = Ext.create('Cms.WindowPost', {});
        this.controllerApp = Ext.create(this.controller, {});
        this.controllerApp.init();

        Ext.apply(this, {
            layout: 'border',
            items: [this.createGrid(), this.createSouth(), this.createEast()]
        });
        this.relayEvents(this.display, ['opentab']);
        this.relayEvents(this.grid, ['rowdblclick']);
        this.callParent(arguments);
    },

    /**
     * Loads a grid.
     * @param {String} controller
     */
    loadWindow: function(controller){
        this.grid.loadWindow(controller);
    },

    /**
     * Creates the grid
     * @private
     * @return {Event.view.EventsGrid} grid
     */
    createGrid: function(){
        this.grid = Ext.create(this.controllerApp.grid, {
            region: 'center',
            dockedItems: [this.createTopToolbar()],
            flex: 2,
            minHeight: 200,
            minWidth: 150,
            listeners: {
                scope: this,
                select: this.onSelect
            }
        });
        this.grid.reconfigure(this.controllerApp.activeStore);
        this.grid.store.autoSync = true;
        this.grid.display = this.display;
        this.grid.window = this;
        //this.loadWindow(this.url);
        return this.grid;
    },

    /**
     * Creates the form
     * @private
     * @return {Event.view.EventsGrid} grid
     */
    createForm: function(){
        //if (this.form !== undefined) {
            this.form = Ext.create(this.controllerApp.form, {
                region: 'center',
                grid: this.grid,
                listeners: {
                    scope: this//,
                    //select: this.onSelect
                }
            });
        //}

        return this.form;
    },

    /**
     * Creates the window
     * @private
     * @return {Event.view.EventsGrid} grid
     */
    createWindow: function(title){
        this.win = Ext.create('widget.window', {
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

        return this.win;
    },

    /**
     * Fires when a grid row is selected
     * @private
     * @param {Event.view.EventsGrid} grid
     * @param {Ext.data.Model} rec
     */
    onSelect: function(grid, rec) {
        this.display.setActive(this, rec);
    },

    /**
     * Creates top controller toolbar.
     * @private
     * @return {Ext.toolbar.Toolbar} toolbar
     */
    createTopToolbar: function(){
        this.toolbar = Ext.create('widget.toolbar', {
            cls: 'x-docked-noborder-top',
            items: [
                /*{
                    iconCls: 'open-all',
                    text: 'Open All',
                    scope: this,
                    handler: this.onOpenAllClick
                },
                '-',*/
                {
                    xtype: 'cycle',
                    text: 'Reading Panel',
                    prependText: 'Preview: ',
                    showText: true,
                    scope: this,
                    changeHandler: this.readingPaneChange,
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
        return this.toolbar;
    },

    /**
     * Reacts to the open all being clicked
     * @private
     */
    onOpenAllClick: function(){
        this.fireEvent('openall', this);
    },

    /**
     * Gets a list of titles/urls for each grid item.
     * @return {Array} The grid details
     */
    getWindowData: function(){
        return this.grid.store.getRange();
    },

    /**
     * @private
     * @param {Ext.button.Button} btn The button
     * @param {Boolean} pressed Whether the button is pressed
     */
    onSummaryToggle: function(btn, pressed) {
        this.grid.getComponent('view').getPlugin('preview').toggleExpanded(pressed);
    },

    /**
     * Handle the checked item being changed
     * @private
     * @param {Ext.menu.CheckItem} activeItem The checked item
     */
    readingPaneChange: function(cycle, activeItem){
        switch (activeItem.text) {
            case 'Bottom':
                this.east.hide();
                this.south.show();
                this.south.add(this.display);
                break;
            case 'Right':
                this.south.hide();
                this.east.show();
                this.east.add(this.display);
                break;
            default:
                this.south.hide();
                this.east.hide();
                break;
        }
    },

    /**
     * Create the south region container
     * @private
     * @return {Ext.panel.Panel} south
     */
    createSouth: function(){
        this.south =  Ext.create('Ext.panel.Panel', {
            layout: 'fit',
            region: 'south',
            border: false,
            split: true,
            flex: 2,
            minHeight: 150,
            items: this.display
        });
        return this.south;
    },

    /**
     * Create the east region container
     * @private
     * @return {Ext.panel.Panel} east
     */
    createEast: function(){
        this.east =  Ext.create('Ext.panel.Panel', {
            layout: 'fit',
            region: 'east',
            flex: 1,
            split: true,
            hidden: true,
            minWidth: 150,
            border: false
        });
        return this.east;
    }
});
