import { Component, Input} from '@angular/core';

@Component({
  selector: 'cancel-item',
  templateUrl: './cancel-item.component.html',
})
export class CancelItemComponent {
  @Input()
  action!: (args: any) => void;
  @Input()
  args!: (args: any) => void;

  handleCancelOrder(): void {
    this.action(this.args);
  }
}
