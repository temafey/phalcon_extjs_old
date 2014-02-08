Ext.define('Cms.WindowInfo', {

    extend: 'Ext.tab.Panel',
    alias: 'widget.cmsWindowInfo',
    requires: ['Cms.WindowDetail'],
    maxTabWidth: 230,
    border: false,

    initComponent: function() {
        this.tabBar = {
            border: true
        };
        /*this.plugins = [{
            ptype: 'tabscrollermenu',
            maxText  : 15,
            pageSize : 5
        }];*/

        this.callParent();
    },

    /**
     * Add a new Window
     * @param {String} title The title of the Window
     * @param {String} controller The url of the Window
     */
    addWindow: function(title, controller) {
        active = this.add({
            xtype: 'cmsWindowDetail',
            title: title,
            controller: controller,
            closable: true,
            closeAction: 'destroy',
            listeners: {
                scope: this,
                opentab: this.onTabOpen,
                openall: this.onOpenAll,
                rowdblclick: this.onRowDblClick
            }
        });
        this.setActiveTab(active);
    },

    openTab: function(title, controller) {
        var active = this.getActiveTab();
        if (!active) {
            this.addWindow(title, controller);
        } else {
            if (active.controller != controller) {
                active = this.items.findBy(function(i){
                    return i.controller === controller;
                });
                if (!active) {
                    this.addWindow(title, controller);
                } else {
                    this.setActiveTab(active);
                }
            }
        }
    },

    /**
     * Listens for a new tab request
     * @private
     * @param {Cms.WindowPost} post
     * @param {Ext.form.Panel} form
     * @param {Ext.data.Model} active
     */
    onTabOpen: function(post, form, active) {
        var me = this,
            items = [],
            item,
            title,
            id;

        if (Ext.isArray(form)) {
            Ext.each(form, function(form) {
                title = form.title;
                if (!me.getTabByTitle(title)) {
                    items.push({
                        inTab: true,
                        xtype: 'cmsWindowPost',
                        title: title,
                        closable: true,
                        parent: post,
                        form: form
                    });
                }
            }, me);
            me.add(items);
        } else {
            id = form.getPrimaryField().getValue();
            title = form.title;
            if (id !== '') {
                title = title+" ("+id+")";
            } else {
                title = title+' (new)';
            }
            item = me.getTabByTitle(title);
            if (!item) {
                item = me.add({
                    inTab: true,
                    xtype: 'cmsWindowPost',
                    title: title,
                    closable: true,
                    parent: post,
                    form: form,
                    active: active
                });
            }
            me.setActiveTab(item);
        }
    },

    /**
     * Find a tab by title
     * @param {String} title The title of the tab
     * @return {Ext.Component} The panel matching the title. null if not found.
     */
    getTabByTitle: function(title) {
        var index = this.items.findIndex('title', title);
        return (index < 0) ? null : this.items.getAt(index);
    },

    /**
     * Listens for a row dblclick
     * @private
     * @param {Cms.WindowDetail} detail The detail
     * @param {Ext.data.Model} model The model
     */
    onRowDblClick: function(info, rec){
        this.onTabOpen(null, rec);
    },

    /**
     * Listens for the open all click
     * @private
     * @param {Cms.WindowDetail}
     */
    onOpenAll: function(detail) {
        this.onTabOpen(null, detail.getWindowData());
    }
});