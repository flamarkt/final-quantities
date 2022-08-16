import app from 'flarum/forum/app';
import {extend} from 'flarum/common/extend';
import OrderTableRow from 'flamarkt/core/forum/components/OrderTableRow';
import QuantityLabel from 'flamarkt/core/common/components/QuantityLabel';

app.initializers.add('flamarkt-final-quantites', () => {
    extend(OrderTableRow.prototype, 'columns', function (columns) {
        if (!columns.has('quantity')) {
            return;
        }

        const original = this.attrs.line.attribute('originalQuantity');
        const quantity = this.attrs.line.quantity();

        // If there is no original quantity saved or if it's the same as the final, don't display anything
        if (!Number.isInteger(original) || original === quantity) {
            return;
        }

        columns.get('quantity').children.unshift(m('del', m(QuantityLabel, {
            value: original,
            product: this.attrs.line.product(),
        })), {tag: '#', children: ' '});
    });
});
