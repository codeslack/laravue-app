const Menu = [
    { header: "Apps" },
    {
        title: "Dashboard",
        group: "apps",
        icon: "mdi-view-dashboard",
        name: "/admin/dashboard"
    },
    {
        title: "Contact",
        group: "apps",
        icon: "mdi-account-box-outline",
        name: "/admin/table"
    },

    {
        title: "Affidavits",
        group: "affidavits",
        icon: "mdi-widgets",
        items: [
            {
                name: "births",
                title: "Birth",
                component: "BirthAff"
            }
            // {
            //     name: "dob",
            //     title: "DOB",
            //     component: "DobAffidavit"
            // },
            // {
            //     name: "dl",
            //     title: "DL",
            //     badge: "new",
            //     component: "DlAffidavit"
            // },
            // {
            //     name: "sameperson",
            //     title: "Same Person",
            //     component: "SamePersonAffidavit"
            // }
        ]
    }
];

// reorder menu
Menu.forEach(item => {
    if (item.items) {
        item.items.sort((x, y) => {
            let textA = x.title.toUpperCase();
            let textB = y.title.toUpperCase();
            return textA < textB ? -1 : textA > textB ? 1 : 0;
        });
    }
});

export default Menu;
