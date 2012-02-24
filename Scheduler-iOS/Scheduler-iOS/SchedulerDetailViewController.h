//
//  SchedulerDetailViewController.h
//  Scheduler-iOS
//
//  Created by NiaN Chen on 2/24/12.
//  Copyright (c) 2012 CN3 Inc. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface SchedulerDetailViewController : UIViewController <UISplitViewControllerDelegate>

@property (strong, nonatomic) id detailItem;

@property (strong, nonatomic) IBOutlet UILabel *detailDescriptionLabel;

@end
