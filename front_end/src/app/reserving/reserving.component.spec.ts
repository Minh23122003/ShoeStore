import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReservingComponent } from './reserving.component';

describe('ReservingComponent', () => {
  let component: ReservingComponent;
  let fixture: ComponentFixture<ReservingComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ReservingComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ReservingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
