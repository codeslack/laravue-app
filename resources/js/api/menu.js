const Menu = [
    { header: "Apps" },
    {
        title: "Dashboard",
        group: "apps",
        icon: "mdi-view-dashboard",
        name: "/dashboard"
    },
    // {
    //     title: "Profile",
    //     group: "apps",
    //     icon: "mdi-account-box-outline",
    //     name: "/profile"
    // },
    {
        title: "Driving",
        group: "drivings",
        component: "drivings",
        icon: "mdi-widgets",
        items: [
            {
                name: "entry",
                title: "Entry",
                component: "FrontEntryDriving"
            },
            {
                name: "process",
                title: "Process",
                component: "FrontProcessDriving"
            },
            {
                name: "success",
                title: "Success",
                component: "FrontSuccessDriving"
            },
            {
                name: "hold",
                title: "Hold",
                component: "FrontHoldDriving"
            },
            {
                name: "reject",
                title: "Reject",
                component: "FrontRejectDriving"
            }
        ]
    },

    {
        title: "Aff",
        group: "affidavits",
        component: "affidavits",
        icon: "mdi-widgets",
        items: [
            {
                name: "birth",
                title: "Birth",
                component: "BirthAffidavit"
            },
            {
                name: "dob",
                title: "DOB",
                component: "DobAffidavit"
            },
            {
                name: "dl",
                title: "DL",
                badge: "new",
                component: "DlAffidavit"
            },
            {
                name: "sameperson",
                title: "Same Person",
                component: "SamePersonAffidavit"
            }
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
