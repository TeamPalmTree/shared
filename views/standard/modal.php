<div id="modal" class="modal" data-bind="modal: visible">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" data-bind="text: title"></div>
            <div class="modal-body">
                <!-- ko if: type() == 'text' -->
                <span data-bind="text: text"></span>
                <!-- /ko -->
                <!-- ko if: type() == 'html' -->
                <span data-bind="html: text"></span>
                <!-- /ko -->
                <!-- ko if: type() == 'template' -->
                <div data-bind="template: { name: template, data: object }">
                </div>
                <!-- /ko -->
            </div>
            <div class="modal-footer" data-bind="visible: type() != 'html'">
                <!-- ko if: type() == 'text' -->
                <button class="btn btn-primary" data-bind="text: ok_text, click: ok"></button>
                <!-- /ko -->
                <!-- ko if: type() != 'text' -->
                <button class="btn" data-bind="text: cancel_text, click: cancel"></button>
                <button class="btn btn-primary" data-bind="text: ok_text, click: ok"></button>
                <!-- /ko -->
            </div>
        </div>
    </div>
</div>