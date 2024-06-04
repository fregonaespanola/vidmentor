<div class="calendar">
        <div class="calendar-header">
            <button class="prev-month">&lt;</button>
            <h2 class="month-year">Mayo 2024</h2>
            <button class="next-month">&gt;</button>
        </div>
        <div class="calendar-body" ondrop="drop(event)" ondragover="allowDrop(event)">
            <div class="calendar-row">
                <div class="calendar-day">Lun</div>
                <div class="calendar-day">Mar</div>
                <div class="calendar-day">Mié</div>
                <div class="calendar-day">Jue</div>
                <div class="calendar-day">Vie</div>
                <div class="calendar-day">Sáb</div>
                <div class="calendar-day">Dom</div>
            </div>
            <div class="tooltip-container"></div>
            <!-- Aquí se generarán dinámicamente los días del mes -->
        </div>
    </div>