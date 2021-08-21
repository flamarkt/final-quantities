import OrderLineEdit from 'flamarkt/core/backoffice/components/OrderLineEdit';
import OrderLineEditState from 'flamarkt/core/backoffice/states/OrderLineEditState';
import OrderShowPage from 'flamarkt/core/backoffice/pages/OrderShowPage';
import {extend} from 'flarum/common/extend';
import Switch from 'flarum/common/components/Switch';
import ItemList from 'flarum/common/utils/ItemList';

app.initializers.add('flamarkt-final-quantites', () => {
    extend(OrderLineEditState.prototype, 'init', function (this: OrderLineEditState, returnValue: any, line: any) {
        this.originalQuantity = line.attribute('originalQuantity') || 0;
        this.isFinal = !!line.attribute('isFinal');
    });

    extend(OrderLineEditState.prototype, 'data', function (this: OrderLineEditState, data: any) {
        data.attributes.originalQuantity = this.originalQuantity;
        data.attributes.isFinal = this.isFinal;
    });

    extend(OrderLineEdit.prototype, 'columns', function (columns: ItemList, line: any, control: any, onchange: any) {
        columns.add('originalQuantity', m('td.OrderLineEdit-OriginalQuantity', m('input.FormControl', {
            type: 'number',
            value: line.originalQuantity,
            onchange: (event: Event) => {
                line.originalQuantity = parseFloat((event.target as HTMLInputElement).value);
                onchange();
            },
        })), -50);

        columns.add('isFinal', m('td.OrderLineEdit-IsFinal', Switch.component({
            state: line.isFinal,
            onchange: (value: boolean) => {
                line.isFinal = value;
                onchange();
            },
        })), -95);
    });

    extend(OrderShowPage.prototype, 'tableHead', function (columns: ItemList) {
        columns.add('originalQuantity', m('th', app.translator.trans('flamarkt-final-quantities.backoffice.orders.lines.head.originalQuantity')), -50);
        columns.add('isFinal', m('th', app.translator.trans('flamarkt-final-quantities.backoffice.orders.lines.head.isFinal')), -95);
    });
});
