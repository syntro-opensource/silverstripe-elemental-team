<div class="container team">
    <div class="row team__row">
        <% loop TeamMembers %>
            <div class="col-12 col-sm-6 col-lg-4 team__membercontainter">
                <% if Portrait %>
                    <img
                        src="$Portrait.ScaleWidth(800).URL"
                        alt="$Title"
                        class="img-fluid"
                        width="$Portrait.ScaleWidth(800).Width"
                        height="$Portrait.ScaleWidth(800).Height"
                        load="lazy"
                    >
                <% end_if %>
                <h3>$Title</h3>
                <% if Position %>
                    <p>$Position</p>
                <% end_if %>
                <p>$Description</p>
            </div>
        <% end_loop %>
    </div>
</div>
