/**
 * Header
 */
Ext.define('Cms.view.Header', {
    extend:'Ext.panel.Panel',
    alias:'widget.view.Header',
    layout:'column',
    id:'header',
    items: [
        {
            xtype:'container',
            columnWidth:.80,
            html:'<image src="./admin/images/logo.png" height="50">',
            border:'none'
        },
        {
            xtype:'container',
            columnWidth:.20,
            items: [
                {
                    xtype:'container',
                    html:'Logged in as',
                    border:'none',
                    id:'loggedin'
                },
                {
                    id:'logoutButton',
                    xtype:'button',
                    iconAlign:'right',
                    iconCls:'logout',
                    text:'Logout',
                    margin:'5 0 0 0',
                    action:'logout'
                }
            ],
            border:'none'
        }
    ]
});