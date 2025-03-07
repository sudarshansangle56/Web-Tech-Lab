import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistionComponent } from './registion.component';

describe('RegistionComponent', () => {
  let component: RegistionComponent;
  let fixture: ComponentFixture<RegistionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RegistionComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RegistionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});