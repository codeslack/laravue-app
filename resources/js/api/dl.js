const Items = [
    {
        uuid: "65a6eb21-67b5-45c3-9af7-faca2d9b60d4",
        name: "Dessie",
        fname: "Web Developer",
        dob: "02-05-1985",
        id_name: "Pan Card",
        id_no: "02-05-1985",
        to_date: "01-05-2019",
        place: "Barua",
        mobile_no: "1-360-812-9380 x511",
        address: "655 Archibald Groves"
    },
    {
        uuid: "28d9f265-74d7-4f85-83d4-6a21fca57dcf",
        name: "Jakayla",
        fname: "Web Developer",
        dob: "03-04-1993",
        id_name: "Voter Card",
        id_no: "02-05-1985",
        to_date: "15-8-2019",
        place: "Barua",
        mobile_no: "1-360-812-9380 x511",
        address: "281 Tillman Forge"
    },

    {
        uuid: "3782c174-1f2c-4dc4-b75d-0bedf400e023",
        name: "Lora Sheet",
        fname: "Webshot Developer",
        dob: "01-01-2001",
        id_name: "Aadhaar Card",
        id_no: "912218711559",
        to_date: "28-09-2019",
        place: "Barua",
        mobile_no: "1-360-812-9380 x511",
        address: "4018 Willms Turnpike"
    }
];

const getUserById = uuid => {
    return uuid === undefined ? Items[0] : Items.find(x => x.uuid === uuid);
};

const getUser = limit => {
    return limit ? Items.slice(0, limit) : Items;
};

export { Items, getUser, getUserById };
