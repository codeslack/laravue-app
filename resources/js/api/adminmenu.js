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
    { header: "Wallets" },
    {
        title: "Wallets",
        group: "wallets",
        component: "wallets",
        icon: "mdi-wallet",
        items: [
            {
                name: "AdminVerifyWallet",
                title: "Verify",
                component: "AdminVerifyWallet"
            },
            {
                name: "AdminSuccessWallet",
                title: "Success",
                component: "AdminSuccessWallet"
            },
            {
                name: "AdminRejectWallet",
                title: "Reject",
                component: "AdminRejectWallet"
            },
            {
                name: "AdminTopupWallet",
                title: "Topup",
                component: "AdminTopupWallet"
            }
        ]
    },

    {
        title: "Driving",
        group: "drivings",
        component: "drivings",
        icon: "mdi-widgets",
        items: [
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
    },
    { header: "Settings" },
    {
        title: "Setting",
        group: "setting",
        icon: "mdi-settings-outline",
        items: [
            {
                name: "CompanyProfile",
                title: "Company Profile",
                component: "CompanyProfile",
                icon: "mdi-chevron-double-right"
            },
            {
                name: "EmailSettings",
                title: "Email Settings",
                component: "EmailSettings",
                icon: "mdi-chevron-double-right"
            },
            {
                name: "FinancialYear",
                title: "Financial Year",
                component: "FinancialYear",
                icon: "mdi-chevron-double-right"
            },
            {
                name: "Countries",
                title: "Countries",
                component: "Countries",
                icon: "mdi-chevron-double-right"
            }
        ]
    }
];

// reorder menu
// Menu.forEach(item => {
//     if (item.items) {
//         item.items.sort((x, y) => {
//             let textA = x.title.toUpperCase();
//             let textB = y.title.toUpperCase();
//             return textA < textB ? -1 : textA > textB ? 1 : 0;
//         });
//     }
// });

export default Menu;
