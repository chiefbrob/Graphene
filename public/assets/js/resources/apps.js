$(".navbar-header .nav a h4").html("MicroApps");
$g.getData([url, "/api/apps/developers"], (apps, developers) => {
  new GrapheneDataGrid({
    ...tableConfig,
    schema: [
      {
        label: "Name",
        name: "name",
        required: true,
        enabled: resource_id == "",
        value: resource_id,
      },
      {
        label: "Description",
        name: "description",
        required: false,
        type: "textarea",
        limit: 1000,
      },
      { label: "Tags", name: "tags", required: false },
      {
        label: "Lead Developer",
        type: "user_id",
        name: "user_id",
        search: "/api/users/search/{{search}}{{value}}?app_developers",
        template:
          "{{attributes.user.first_name}} {{attributes.user.last_name}} - {{attributes.user.email}}",
      },
      { name: "id", type: "hidden" },
    ],
    actions: [
      { name: "delete" },
      "|",
      { name: "edit", max: 1 },
      {
        name: "developers",
        max: 1,
        min: 1,
        label: '<i class="fa fa-code"></i> Developers',
      },
      "|",
      { name: "create" },
    ],
    name: "apps",
    data: apps,
  })
    .on("click", e => {
      window.location = "/admin/" + route + "/" + e.model.attributes.id;
    })
    .on("model:developers", e => {
      window.location = "/admin/apps/" + e.model.attributes.id + "/developers";
    });
});
